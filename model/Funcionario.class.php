<?php
    require_once("Model.class.php");

    /* Classe modelo de Funcionario */
    class Funcionario extends Model {
        /* Atributos */
        protected $id;
        protected $matricula;
        protected $nome;
        protected $sobrenome;
        protected $email;
        protected $dataEfetivacao;
        protected $genero;
        protected $dataNascimento;
        protected $rg;
        protected $cpf;
        protected $salario;
        protected $avatar;

        /*
        * Pega as inicias do nome do funcionário
        * @return string Primeira letra do nome e do último nome caso exista
        */
        public function getIniciaisNome() {
            $iniciaisNome = "";
            $listaNomes = explode(" ", $this->nome . " " . $this->sobrenome);
            $quantidadeNomes = count($listaNomes);
            if ($quantidadeNomes > 0) {
                $iniciaisNome .= substr($listaNomes[0], 0, 1);
                if ($quantidadeNomes > 1) {
                    $iniciaisNome .= substr($listaNomes[$quantidadeNomes - 1], 0, 1);
                }
            }

            return strtoupper($iniciaisNome);
        }

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function getMatricula() {
            return $this->matricula;
        }

        public function setMatricula($matricula) {
            $this->matricula = $matricula;
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

        public function getDataEfetivacao() {
            return $this->dataEfetivacao;
        }

        public function setDataEfetivacao($dataEfetivacao) {
            $this->dataEfetivacao = $dataEfetivacao;
        }

        public function getGenero() {
            return $this->genero;
        }

        public function setGenero($genero) {
            $this->genero = $genero;
        }

        public function getDataNascimento() {
            return $this->dataNascimento;
        }

        public function setDataNascimento($dataNascimento) {
            $this->dataNascimento = $dataNascimento;
        }

        public function getRg() {
            return $this->rg;
        }

        public function setRg($rg) {
            $this->rg = $rg;
        }

        public function getCpf() {
            return $this->cpf;
        }

        public function setCpf($cpf) {
            $this->cpf = $cpf;
        }

        public function getSalario() {
            return $this->salario;
        }

        public function setSalario($salario) {
            $this->salario = $salario;
        }

        public function getAvatar() {
            return $this->avatar;
        }

        public function setAvatar($avatar) {
            $this->avatar = $avatar;
        }
    }
?>
