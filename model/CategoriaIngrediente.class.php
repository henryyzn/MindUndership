<?php
    require_once("Model.class.php");

    class CategoriaIngrediente extends Model {
        protected $id;
        protected $titulo;
        protected $foto;
        protected $ativo = false;
        protected $parent;

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

        public function isAtivo() {
            return $this->ativo;
        }

        public function setAtivo($ativo) {
            $this->ativo = $ativo;
        }

        public function getParent() {
            return $this->parent;
        }

        public function setParent($parent) {
            $this->parent = $parent;
        }
    }
?>
