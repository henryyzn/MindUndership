<?php
    require_once("Controller.class.php");
    require_once(__DIR__ . "/../model/PersonalFitness.class.php");
    require_once(__DIR__ . "/../model/dao/PersonalFitnessDAO.class.php");

    class PersonalFitnessController extends Controller {
        public function init() {
            $this->criarRota("GET", "personal_fitness", "listar");
            $this->criarRota("POST", "personal_fitness", "inserir");
            $this->criarRota("GET", "personal_fitness/{id}", "selecionarItem");
            $this->criarRota("PUT", "personal_fitness/{id}", "atualizar");
            $this->criarRota("PUT", "personal_fitness/{id}/ativar", "ativar");
            $this->criarRota("DELETE", "personal_fitness/{id}", "excluir");
        }

        public function listar() {
            $this->api->enviarResultado(PersonalFitnessDAO::listar());
        }

        public function inserir() {
            session_start();
            $item = new PersonalFitness($this->dados);
            $item->setIdFuncionario($_SESSION["funcionario"]->getId());
            $resultado = PersonalFitnessDAO::inserir($item);
            if ($resultado) {
                $this->api->enviarResultado($resultado);
            } else {
                $this->api->enviarStatus(500, "Não foi possível inserir.");
            }
        }

        public function selecionarItem($id) {
            $item = PersonalFitnessDAO::selecionar($id);
            if ($item) {
                $this->api->enviarResultado($item);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }

        public function atualizar($id) {
            $item = new PersonalFitness($this->dados);
            if (PersonalFitnessDAO::atualizar($id, $item)) {
                $this->api->enviarResultado($item);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }

        public function ativar($id) {
            if (PersonalFitnessDAO::ativar($id)) {
               $this->api->enviarStatus(204);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }

        public function excluir($id) {
            if (PersonalFitnessDAO::excluir($id)) {
                $this->api->enviarStatus(204);
            } else {
                $this->api->enviarStatus(404, "Item não encontrado");
            }
        }
    }
?>
