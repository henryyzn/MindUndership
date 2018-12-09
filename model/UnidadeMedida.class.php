<?php
    require_once("Model.class.php");

    class UnidadeMedida extends Model {
        protected $id;
        protected $unidadeMedida;
        protected $sigla;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getUnidadeMedida() {
            return $this->unidadeMedida;
        }

        public function setUnidadeMedida($unidadeMedida) {
            $this->unidadeMedida = $unidadeMedida;
        }

        public function getSigla() {
            return $this->sigla;
        }

        public function setSigla($sigla) {
            $this->sigla = $sigla;
        }
    }
?>
