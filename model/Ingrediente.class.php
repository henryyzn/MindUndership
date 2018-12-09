<?php
    require_once("Model.class.php");
    require_once("UnidadeMedida.class.php");
    require_once("CategoriaIngrediente.class.php");

    /* Classe modelo de Ingrediente */
    class Ingrediente extends Model {
        /* Atributos */
        protected $id;
        protected $titulo;
        protected $foto;
        protected $descricao;
        protected $ativo = false;
        protected $preco;
        protected $valorEnergetico;
        protected $carboidratos;
        protected $proteinas;
        protected $gorduraTotal;
        protected $gorduraSaturada;
        protected $gorduraTrans;
        protected $fibraAlimentar;
        protected $sodio;
        protected $ingrediente;
        protected $categoria;
        protected $unidadeMedida;

        public function getType($propriedade) {
            if ($propriedade === "unidadeMedida") {
                return UnidadeMedida::class;
            } else if ($propriedade === "categoria") {
                return CategoriaIngrediente::class;
            }
        }

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

        public function getDescricao() {
            return $this->descricao;
        }

        public function setDescricao($descricao) {
            $this->descricao = $descricao;
        }

        public function isAtivo() {
            return $this->ativo;
        }

        public function setAtivo($ativo) {
            $this->ativo = $ativo;
        }

        public function getPreco() {
            return $this->preco;
        }

        public function setPreco($preco) {
            $this->preco = $preco;
        }

        public function getValorEnergetico() {
            return $this->valorEnergetico;
        }

        public function setValorEnergetico($valorEnergetico) {
            $this->valorEnergetico = $valorEnergetico;
        }

        public function getCarboidratos() {
            return $this->carboidratos;
        }

        public function setCarboidratos($carboidratos) {
            $this->carboidratos = $carboidratos;
        }

        public function getProteinas() {
            return $this->proteinas;
        }

        public function setProteinas($proteinas) {
            $this->proteinas = $proteinas;
        }

        public function getGorduraTotal() {
            return $this->gorduraTotal;
        }

        public function setGorduraTotal($gorduraTotal) {
            $this->gorduraTotal = $gorduraTotal;
        }

        public function getGorduraSaturada() {
            return $this->gorduraSaturada;
        }

        public function setGorduraSaturada($gorduraSaturada) {
            $this->gorduraSaturada = $gorduraSaturada;
        }

        public function getGorduraTrans() {
            return $this->gorduraTrans;
        }

        public function setGorduraTrans($gorduraTrans) {
            $this->gorduraTrans = $gorduraTrans;
        }

        public function getFibraAlimentar() {
            return $this->fibraAlimentar;
        }

        public function setFibraAlimentar($fibraAlimentar) {
            $this->fibraAlimentar = $fibraAlimentar;
        }

        public function getSodio() {
            return $this->sodio;
        }

        public function setSodio($sodio) {
            $this->sodio = $sodio;
        }

        public function getUnidadeMedida() {
            return $this->unidadeMedida;
        }

        public function setUnidadeMedida($unidadeMedida) {
            $this->unidadeMedida = $unidadeMedida;
        }

        public function getCategoria() {
            return $this->categoria;
        }

        public function setCategoria($categoria) {
            $this->categoria = $categoria;
        }
    }
?>
