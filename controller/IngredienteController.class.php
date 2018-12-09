<?php
    require_once("Controller.class.php");
    require_once(__DIR__ . "/../model/Ingrediente.class.php");
    require_once(__DIR__ . "/../model/dao/IngredienteDAO.class.php");
    require_once(__DIR__ . "/../model/dao/UnidadeMedidaDAO.class.php");

    class IngredienteController extends Controller {
        /* Inicializa todas as rotas que serão tratadas */
        public function init() {
            $this->criarRota("GET", "ingrediente", "listarTodos");
            $this->criarRota("POST", "ingrediente", "inserir");
            $this->criarRota("GET", "ingrediente/{id}", "selecionarItem");
            $this->criarRota("PUT", "ingrediente/{id}", "atualizar");
            $this->criarRota("PUT", "ingrediente/{id}/ativar", "ativar");
            $this->criarRota("DELETE", "ingrediente/{id}", "excluir");
        }

        public function listarTodos() {
            $this->api->enviarResultado(IngredienteController::listar());
        }

        public function inserir() {
            $ingrediente = new Ingrediente($this->dados);
            if (!$ingrediente->getUnidadeMedida() || !$ingrediente->getCategoria()) {
                $this->api->enviarStatus(403, "Preencha todos os campos.");
            } else {
                try {
                    $ingrediente->startUpload("assets/images/ingredientes");
                    $resultado = IngredienteDAO::inserir($ingrediente);
                    if ($resultado) {
                        $this->api->enviarResultado($resultado);
                    } else {
                        $this->api->enviarStatus(500, "Não foi possível inserir.");
                    }

                } catch (Exception $erro) {
                    $this->api->enviarStatus(500, $erro->getMessage());
                }
            }
        }

        public function selecionarItem($id) {
            $ingrediente = IngredienteDAO::selecionar($id);
            if ($ingrediente) {
                $this->api->enviarResultado($ingrediente);
            } else {
                $this->api->enviarStatus(404, "Ingrediente não encontrado");
            }
        }

        public function atualizar($id) {
            $ingrediente = new Ingrediente($this->dados);
            try {
                $ingrediente->startUpload("assets/images/ingredientes");
                $resultado = IngredienteDAO::atualizar($id, $ingrediente);
                if ($resultado) {
                   $this->api->enviarResultado($resultado);
                } else {
                    $this->api->enviarStatus(404, "Ingrediente não encontrado");
                }

            } catch (Exception $erro) {
                $this->api->enviarStatus(500, $erro->getMessage());
            }
        }

        public function ativar($id) {
            if (IngredienteDAO::ativar($id)) {
               $this->api->enviarStatus(204);
            } else {
                $this->api->enviarStatus(404, "Ingrediente não encontrado");
            }
        }

        public function excluir($id) {
            if (IngredienteDAO::excluir($id)) {
                $this->api->enviarStatus(204);
            } else {
                $this->api->enviarStatus(404, "Ingrediente não encontrado");
            }
        }

        public static function listar() {
            return IngredienteDAO::listar();
        }

        public static function listarUnidadesMedida() {
            return UnidadeMedidaDAO::listar();
        }
    }
?>
