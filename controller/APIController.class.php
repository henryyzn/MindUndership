<?php
    /* Classe responsável por controlar e tratar resquisições da API */
    class APIController {
        /* URL requisitada pelo usuário para API */
        private $url = "";

        /* Método HTTP utilizado: GET, POST, PUT ou DELETE */
        private $metodo = "";

        /* Dados enviado pela requisição via "body" em formato JSON */
        public $dados = array();

        /* Varíavel para definir se a API foi executada com sucesso ou não */
        public $sucesso = false;

        /* Lista de respostas HTTP para serem tratadas pelo cliente */
        private $listaStatus = array(
            204 => "No Content",
            401 => "Unauthorized",
            403 => "Forbidden",
            404 => "Not Found",
            405 => "Method Not Allowed",
            500 => "Internal Server Error",
        );

        /* Método contrutor */
        public function __construct() {
            /* Pega a url da requisição que foi mandada pelo arquivo .htaccess */
            if (isset($_GET["request"])) {
                $this->url = $_GET["request"];

                /* Define qual é o método HTTP que está sendo utilizado no momento */
                $this->metodo = $_SERVER["REQUEST_METHOD"];

                /* Verfica se o método da requsição é autorizado pela API e decodifica os dados recebidos em formato JSON (ou via URL caso a requisição seja em GET) */
                if ($this->metodo == "POST" || $this->metodo == "PUT" || $this->metodo == "DELETE") {
                    /* Verfica se os dados que foram enviados é um JSON */
                    if (json_decode(file_get_contents("php://input"))) {
                        $this->dados = json_decode(file_get_contents("php://input"));
                    } else {
                        /* Transforma $_POST em um objeto do PHP */
                        $this->dados = (object) $_POST;
                    }

                } else if ($this->metodo == "GET") {
                    /* Transforma $_GET em um objeto do PHP */
                    $this->dados = (object) $_GET;
                } else {
                    $this->enviarStatus(405, "Metodo não autorizado");
                }
            }

            $this->inicializar();
        }

        /*
        * Envia um status de uma resposta HTTP para o cliente e imprime opcionalmente uma mensagem para o usuário
        * @param $status código de status para ser enviado ao cliente
        * @param $resultado uma mensagem qualquer para ser exibida ao cliente, por padrão vazia
        */
        public function enviarStatus($status, $resultado = "") {
            header("HTTP/1.1 " . $status . " " . $this->procurarStatus($status));
            if ($resultado) {
                $this->enviarResultado(array("result" => $resultado));
            }
        }

        /*
        * Procura uma descrição para uma resposta HTTP
        * @param $status código de status para ser procurado
        * @return string descrição para a resposta HTTP, ou por padrão a descrição da resposta de status 500 (erro no servidor)
        */
        private function procurarStatus($status) {
            return $this->listaStatus[$status] ? $this->listaStatus[$status] : $this->listaStatus[500];
        }

        /*
        * Imprime um resultado para o cliente em formato JSON
        * @param $resultado uma mensagem para ser mostrada
        */
        public function enviarResultado($resultado) {
            header("Content-Type: application/json");
            echo(preg_replace("/,\s*\"[^\"]+\":null|\"[^\"]+\":null,?/", "", json_encode($resultado, JSON_UNESCAPED_UNICODE)));
        }


        /*
        * Cria uma rota para ser tratada pela api
        * @param $metodo método HTTP que será tratado por esta rota (GET, POST, PUT, DELETE),
        * @param $rota a rota a ser tratada pela api (Exemplo: "usuarios/{idUsuario}/tarefas/{idTarefa}")
        * @param $funcao uma função que será executada caso a rota esteja correta
        */
        public function criarRota($metodo, $rota, $funcao) {
            /* Verifica a API ainda não teve sucesso e se o método HTTP requisitado pela rota é o mesmo que foi recebido */
            if (!$this->sucesso && $metodo == $this->metodo) {

                /* Substitui / por \\/ na rota */
                $rota = str_replace("/", "\\/", $rota);

                /* Substitui qualquer coisa que esteja entre {} por uma expressão regular que o PHP consiga capturar */
                $rota = preg_replace("/\{(\w+)\}/", "(\w+)", $rota);

                /* Cria uma expressão regular para procurar os parâmetros da url entre {} */
                $regex = "/^" . $rota . "$/";

                /* Joga os parâmetros da url em um array */
                preg_match($regex, $this->url, $resultado);

                /* Verifica se a rota consiste com a requisição do usuário */
                if (!empty($resultado)) {
                    /* Remove o primeiro índice do resultado */
                    array_shift($resultado);

                    /* Chama a função, passando o resultado da expressão regular como parâmetros */
                    call_user_func_array($funcao, $resultado);

                    /* Define que a API foi executada com sucesso */
                    $this->sucesso = true;
                }
            }
        }

        /* Inicializa todas as rotas declaradas */
        public function inicializar() {
            /* Faz um loop em todas as classes PHP */
            foreach (get_declared_classes() as $nomeClasse) {
                /* Verifica se a classe extende a classe "Controller" */
                if (in_array("Controller", class_parents($nomeClasse))) {
                    /* Cria uma nova instância da classe */
                    $classe = new $nomeClasse($this);
                    /* Chama o método init dessa nova classe */
                    $classe->init();
                }
            }

            /* Caso nenhuma rota tenha sido encontrada, retorna uma mensagem */
            if (!$this->sucesso) {
                $this->enviarResultado(array("erro" => "Rota não encontrada"));
            }
        }
    }
?>
