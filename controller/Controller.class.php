<?php
    abstract class Controller {
        protected $api;

        public function __construct($api) {
            $this->api = $api;
        }

        public function criarRota($metodo, $rota, $funcao) {
            $this->api->criarRota($metodo, $rota, [$this, $funcao]);
        }

        public function __get($propriedade) {
            if ($propriedade == "dados") {
                return $this->api->dados;
            }
        }
    }
?>
