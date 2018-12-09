<?php
    require_once("Controller.class.php");
    require_once(__DIR__ . "/../model/PorQueComidaFitness.class.php");
    require_once(__DIR__ . "/../model/dao/PorQueComidaFitnessDAO.class.php");

    class PorQueComidaFitnessController extends Controller {
        public function init() {
            $this->criarRota("GET", "porque_comida_fitness", "listar");
            $this->criarRota("POST", "porque_comida_fitness", "inserir");
            $this->criarRota("GET", "porque_comida_fitness/{id}", "selecionarItem");
            $this->criarRota("PUT", "porque_comida_fitness/{id}", "atualizar");
            $this->criarRota("PUT", "porque_comida_fitness/{id}/ativar", "ativar");
            $this->criarRota("DELETE", "porque_comida_fitness/{id}", "excluir");
        }

        public function listar() {
            $this->api->enviarResultado(PorQueComidaFitnessDAO::listar());
        }

        public function inserir() {
            session_start();
            $item = new PorQueComidaFitness($this->dados);
            $item->setIdFuncionario($_SESSION["funcionario"]->getId());
            $resultado = PorQueComidaFitnessDAO::inserir($item);
            if ($resultado) {
                $this->api->enviarResultado($resultado);
            } else {
                $this->api->enviarStatus(500, "Não foi possível inserir.");
            }
        }

        public function selecionarItem($id) {
            $item = PorQueComidaFitnessDAO::selecionar($id);
            if ($item) {
                $this->api->enviarResultado($item);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }

        public function atualizar($id) {
            $item = new PorQueComidaFitness($this->dados);
            if (PorQueComidaFitnessDAO::atualizar($id, $item)) {
                $this->api->enviarResultado($item);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }

        public function ativar($id) {
            if (PorQueComidaFitnessDAO::ativar($id)) {
               $this->api->enviarStatus(204);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }

        public function excluir($id) {
            if (PorQueComidaFitnessDAO::excluir($id)) {
                $this->api->enviarStatus(204);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }
    }
?>
