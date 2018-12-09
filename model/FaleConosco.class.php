<?php
    require_once("Model.class.php");

    class FaleConosco extends Model{
        protected $id;
        protected $nome;
        protected $sobrenome;
        protected $email;
        protected $telefone;
        protected $celular;
        protected $assunto;
        protected $comentario;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }


        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }


        public function getSobrenome() {
            return $this->sobrenome;
        }

        public function setSobrenome($sobrenome) {
            $this->sobrenome = $sobrenome;
        }


        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
        }


        public function getTelefone() {
            return $this->telefone;
        }

        public function setTelefone($telefone) {
            $this->telefone = $telefone;
        }


        public function getCelular() {
            return $this->celular;
        }

        public function setCelular($celular) {
            $this->celular = $celular;
        }


        public function getAssunto() {
            return $this->assunto;
        }

        public function setAssunto($assunto) {
            $this->assunto = $assunto;
        }


        public function getComentario() {
            return $this->comentario;
        }

        public function setComentario($comentario) {
            $this->comentario = $comentario;
        }
    }
?>
