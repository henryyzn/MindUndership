<?php
    require_once("Controller.class.php");
    require_once(__DIR__ . "/../model/ItemSobreNos.class.php");
    require_once(__DIR__ . "/../model/dao/SobreNosDAO.class.php");

    class SobreNosController extends Controller {
        /* Inicializa todas as rotas que serão tratadas */
        public function init() {
            $this->criarRota("GET", "sobre-nos", "listar");
            $this->criarRota("POST", "sobre-nos", "inserir");
            $this->criarRota("GET", "sobre-nos/{id}", "selecionarItem");
            $this->criarRota("PUT", "sobre-nos/{id}", "atualizar");
            $this->criarRota("PUT", "sobre-nos/{id}/ativar", "ativar");
            $this->criarRota("DELETE", "sobre-nos/{id}", "excluir");
        }

        public function listar() {
            $this->api->enviarResultado(SobreNosDAO::listar());
        }

        public function inserir() {
            $item = new ItemSobreNos($this->dados);
            try {
                $item->startUpload("assets/images/sobre-nos");
                if (SobreNosDAO::inserir($item)) {
                    $this->api->enviarResultado($item);
                }

            } catch (Exception $erro) {
                $this->api->enviarStatus(500, $erro->getMessage());
            }
        }

        public function selecionarItem($id) {
            $item = SobreNosDAO::selecionar($id);
            if ($item) {
                $this->api->enviarResultado($item);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }

        public function atualizar($id) {
            $item = new ItemSobreNos($this->dados);
            try {
                $item->startUpload("assets/images/sobre-nos");
                if (SobreNosDAO::atualizar($id, $item)) {
                   $this->api->enviarResultado($item);
                } else {
                    $this->api->enviarStatus(404, "Item não encontrado");
                }

            } catch (Exception $erro) {
                $this->api->enviarStatus(500, $erro->getMessage());
            }
        }

        public function ativar($id) {
            if (SobreNosDAO::ativar($id)) {
               $this->api->enviarStatus(204);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }

        public function excluir($id) {
            if (SobreNosDAO::excluir($id)) {
                $this->api->enviarStatus(204);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }
    }
?>
