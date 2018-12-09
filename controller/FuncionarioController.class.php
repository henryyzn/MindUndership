<?php
    require_once("Controller.class.php");
    require_once(__DIR__ . "/../model/Funcionario.class.php");
    require_once(__DIR__ . "/../model/dao/FuncionarioDAO.class.php");

    /* Classe responsável por controlar todas as APIs relacionadas a funcionário */
    class FuncionarioController extends Controller {
        /* Inicializa todas as rotas que serão tratadas */
        public function init() {
            $this->criarRota("POST", "funcionarios/login", "login");
            $this->criarRota("POST", "funcionarios/logout", "logout");
        }

        /* Login de funcionários no CMS */
        public function login() {
            $funcionario = FuncionarioDAO::login($this->dados->matricula, $this->dados->senha);
            if ($funcionario) {
                session_start();
                $_SESSION["funcionario"] = $funcionario;

                $this->api->enviarStatus(204);
            } else {
                $this->api->enviarStatus(401);
            }
        }

        /* Efetua o logout de um usuário logado */
        public function logout() {
            session_start();
            if (isset($_SESSION["funcionario"])) {
                session_destroy();
                $this->api->enviarStatus(204);
            } else {
                $this->api->enviarStatus(401);
            }
        }

        /*
        * Pega o funcionario atual logado em sessão
        * @return Funcionario Caso possua um login em sessão
        * @return null Caso não esteja logado
        */
        public static function getFuncionarioAtual() {
            session_start();
            if (isset($_SESSION["funcionario"])) {
                return $_SESSION["funcionario"];
            } else {
                return null;
            }
        }
    }
?>
