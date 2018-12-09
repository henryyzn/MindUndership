<?php
    require_once("Model.class.php");

    class DicasSaude extends Model {
        protected $id;
        protected $idFuncionario;
        protected $titulo;
        protected $texto;
        protected $ativo = true;
        protected $data;
        protected $autor;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getIdFuncionario() {
            return $this->idFuncionario;
        }

        public function setIdFuncionario($idFuncionario) {
            $this->idFuncionario = $idFuncionario;
        }

        public function getTitulo() {
            return $this->titulo;
        }

        public function setTitulo($titulo) {
            $this->titulo = $titulo;
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

        public function getData() {
            return $this->data;
        }

        public function setData($data) {
            $this->data = $data;
        }

        public function getAutor() {
            return $this->autor;
        }

        public function setAutor($autor) {
            $this->autor = $autor;
        }
    }
?>
