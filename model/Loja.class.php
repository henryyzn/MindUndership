<?php

//SEMPRE QUE EU CRIAR UM OBJETO, COMEÇO PELA CLASS
//Protected -> Pode ser acessado apenas por métodos da própria classe e classes filhas
//construct -> Método chamado automáticamente quando eu chamo alguma NEW
//Paret -> Classe que esta sendo extendida
//Get ->
//Set ->
//json -> Parametro interno, pegando objetos e jogando automaticamente
    require_once("Model.class.php");

    class Loja extends Model {
        protected $id;
        protected $latitude;
        protected $longitude;
        protected $funcionamento;
        protected $ativo = true;
        protected $telefone;
        protected $logradouro;
        protected $cep;
        protected $numero;
        protected $bairro;
        protected $complemento;
        protected $cidade;
        protected $estado;
        protected $idCidade;
        protected $idEstado;
        protected $idEndereco;
        protected $uf;

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getLatitude(){
            return $this->latitude;
        }

        public function setLatitude($latitude){
            $this->latitude = $latitude;
        }

        public function getLongitude(){
            return $this->longitude;
        }

        public function setLongitude($longitude){
            $this->longitude = $longitude;
        }

        public function getFuncionamento(){
            return $this->funcionamento;
        }

        public function setFuncionamento($funcionamento){
            $this->funcionamento = $funcionamento;
        }

        public function getAtivo(){
            return $this->ativo;
        }

        public function setAtivo($ativo){
            $this->ativo = $ativo;
        }

        public function getTelefone(){
            return $this->telefone;
        }

        public function setTelefone($telefone){
            $this->telefone = $telefone;
        }

        public function getLogradouro(){
            return $this->logradouro;
        }

        public function setLogradouro($logradouro){
            $this->logradouro = $logradouro;
        }

        public function getCep(){
            return $this->cep;
        }

        public function setCep($cep){
            $this->cep = $cep;
        }

        public function getNumero(){
            return $this->numero;
        }

        public function setNumero($numero){
            $this->numero = $numero;
        }

        public function getBairro(){
            return $this->bairro;
        }

        public function setBairro($bairro){
            $this->bairro = $bairro;
        }

        public function getComplemento(){
            return $this->complemento;
        }

        public function setComplemento($complemento){
            $this->complemento = $complemento;
        }

        public function getCidade(){
            return $this->cidade;
        }

        public function setCidade($cidade){
            $this->cidade = $cidade;
        }

        public function getEstado(){
            return $this->estado;
        }

        public function setEstado($estado){
            $this->estado = $estado;
        }

        public function getIdCidade(){
            return $this->idCidade;
        }

        public function setIdCidade($idCidade){
            $this->idCidade = $idCidade;
        }

        public function getIdEstado(){
            return $this->idEstado;
        }

        public function setIdEstado($idEstado){
            $this->idEstado = $idEstado;
        }

        public function getUf(){
            return $this->uf;
        }

        public function setUf($uf){
            $this->uf = $uf;
        }

        public function getIdEndereco(){
            return $this->idEndereco;
        }

        public function setIdEndereco($idEndereco){
            $this->idEndereco = $idEndereco;
        }
    }
?>
