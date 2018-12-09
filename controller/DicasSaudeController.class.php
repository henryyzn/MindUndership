<?php
    require_once("Controller.class.php");
    require_once(__DIR__ . "/../model/DicasSaude.class.php");
    require_once(__DIR__ . "/../model/dao/DicasSaudeDAO.class.php");

    class DicasSaudeController extends Controller {
        public function init() {
            $this->criarRota("GET", "dicas_saude", "listar");
            $this->criarRota("POST", "dicas_saude", "inserir");
            $this->criarRota("GET", "dicas_saude/{id}", "selecionarItem");
            $this->criarRota("PUT", "dicas_saude/{id}", "atualizar");
            $this->criarRota("PUT", "dicas_saude/{id}/ativar", "ativar");
            $this->criarRota("DELETE", "dicas_saude/{id}", "excluir");
        }

        public function listar() {
            $this->api->enviarResultado(DicasSaudeDAO::listar());
        }

        public function inserir() {
            session_start();
            $item = new DicasSaude($this->dados);
            $item->setIdFuncionario($_SESSION["funcionario"]->getId());
            $resultado = DicasSaudeDAO::inserir($item);
            if ($resultado) {
                $this->api->enviarResultado($resultado);
            } else {
                $this->api->enviarStatus(500, "Não foi possível inserir.");
            }
        }

        public function selecionarItem($id) {
            $item = DicasSaudeDAO::selecionar($id);
            if ($item) {
                $this->api->enviarResultado($item);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }

        public function atualizar($id) {
            $item = new DicasSaude($this->dados);
            if (DicasSaudeDAO::atualizar($id, $item)) {
                $this->api->enviarResultado($item);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }

        public function ativar($id) {
            if (DicasSaudeDAO::ativar($id)) {
               $this->api->enviarStatus(204);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }

        public function excluir($id) {
            if (DicasSaudeDAO::excluir($id)) {
                $this->api->enviarStatus(204);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }
    }
?>
