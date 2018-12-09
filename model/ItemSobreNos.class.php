<?php
    require_once("Model.class.php");

    /* Classe modelo de Sobre Nós */
    class ItemSobreNos extends Model {
        /* Atributos */
        protected $id;
        protected $titulo;
        protected $foto;
        protected $texto;
        protected $ativo = true;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getTitulo() {
            return $this->titulo;
        }

        public function setTitulo($titulo) {
            $this->titulo = $titulo;
        }

        public function getFoto() {
            return $this->foto;
        }

        public function setFoto($foto) {
            $this->foto = $foto;
        }

        public function getTexto() {
            return $this->texto;
        }

        public function setTexto($texto) {
            $this->texto = $texto;
        }

        public function isAtivo() {
            return $this->ativo;
        }

        public function setAtivo($ativo) {
            $this->ativo = $ativo;
        }
    }
?>
