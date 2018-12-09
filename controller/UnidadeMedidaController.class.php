<?php
    require_once("Controller.class.php");
    require_once(__DIR__ . "/../model/UnidadeMedida.class.php");
    require_once(__DIR__ . "/../model/dao/UnidadeMedidaDAO.class.php");

    class UnidadeMedidaController extends Controller {
        public function init() {
            $this->criarRota("GET", "unidade-medida", "listar");
        }

        public function listar() {
            $this->api->enviarResultado(UnidadeMedidaDAO::listar());
        }
    }
?>
