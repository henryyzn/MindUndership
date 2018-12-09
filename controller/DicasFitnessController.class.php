<?php
    require_once("Controller.class.php");
    require_once(__DIR__ . "/../model/DicasFitness.class.php");
    require_once(__DIR__ . "/../model/dao/DicasFitnessDAO.class.php");

    class DicasFitnessController extends Controller {
        public function init() {
            $this->criarRota("GET", "dicas_fitness", "listar");
            $this->criarRota("POST", "dicas_fitness", "inserir");
            $this->criarRota("GET", "dicas_fitness/{id}", "selecionarItem");
            $this->criarRota("PUT", "dicas_fitness/{id}", "atualizar");
            $this->criarRota("PUT", "dicas_fitness/{id}/ativar", "ativar");
            $this->criarRota("DELETE", "dicas_fitness/{id}", "excluir");
        }

        public function listar() {
            $this->api->enviarResultado(DicasFitnessDAO::listar());
        }

        public function inserir() {
            session_start();
            $item = new DicasFitness($this->dados);
            $item->setIdFuncionario($_SESSION["funcionario"]->getId());
            $resultado = DicasFitnessDAO::inserir($item);
            if ($resultado) {
                $this->api->enviarResultado($resultado);
            } else {
                $this->api->enviarStatus(500, "Não foi possível inserir.");
            }
        }

        public function selecionarItem($id) {
            $item = DicasFitnessDAO::selecionar($id);
            if ($item) {
                $this->api->enviarResultado($item);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }

        public function atualizar($id) {
            $item = new DicasFitness($this->dados);
            if (DicasFitnessDAO::atualizar($id, $item)) {
                $this->api->enviarResultado($item);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }

        public function ativar($id) {
            if (DicasFitnessDAO::ativar($id)) {
               $this->api->enviarStatus(204);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }

        public function excluir($id) {
            if (DicasFitnessDAO::excluir($id)) {
                $this->api->enviarStatus(204);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }
    }
?>
