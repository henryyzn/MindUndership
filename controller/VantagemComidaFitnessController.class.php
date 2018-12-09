<?php
    require_once("Controller.class.php");
    require_once(__DIR__ . "/../model/VantagemComidaFitness.class.php");
    require_once(__DIR__ . "/../model/dao/VantagemComidaFitnessDAO.class.php");

    class VantagemComidaFitnessController extends Controller {
        public function init() {
            $this->criarRota("GET", "vantagem_comida_fitness", "listar");
            $this->criarRota("POST", "vantagem_comida_fitness", "inserir");
            $this->criarRota("GET", "vantagem_comida_fitness/{id}", "selecionarItem");
            $this->criarRota("PUT", "vantagem_comida_fitness/{id}", "atualizar");
            $this->criarRota("PUT", "vantagem_comida_fitness/{id}/ativar", "ativar");
            $this->criarRota("DELETE", "vantagem_comida_fitness/{id}", "excluir");
        }

        public function listar() {
            $this->api->enviarResultado(VantagemComidaFitnessDAO::listar());
        }

        public function inserir() {
            session_start();
            $item = new VantagemComidaFitness($this->dados);
            $item->setIdFuncionario($_SESSION["funcionario"]->getId());
            $resultado = VantagemComidaFitnessDAO::inserir($item);
            if ($resultado) {
                $this->api->enviarResultado($resultado);
            } else {
                $this->api->enviarStatus(500, "Não foi possível inserir.");
            }
        }

        public function selecionarItem($id) {
            $item = VantagemComidaFitnessDAO::selecionar($id);
            if ($item) {
                $this->api->enviarResultado($item);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }

        public function atualizar($id) {
            $item = new VantagemComidaFitness($this->dados);
            if (VantagemComidaFitnessDAO::atualizar($id, $item)) {
                $this->api->enviarResultado($item);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }

        public function ativar($id) {
            if (VantagemComidaFitnessDAO::ativar($id)) {
               $this->api->enviarStatus(204);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }

        public function excluir($id) {
            if (VantagemComidaFitnessDAO::excluir($id)) {
                $this->api->enviarStatus(204);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }
    }
?>
