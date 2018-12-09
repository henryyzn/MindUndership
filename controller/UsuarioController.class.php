<?php
    require_once("Controller.class.php");
    require_once(__DIR__ . "/../model/Usuario.class.php");
    require_once(__DIR__ . "/../model/dao/UsuarioDAO.class.php");

    class UsuarioController extends Controller {
        public function init() {
            $this->criarRota("POST", "usuario/mobile/login", "loginMobile");
        }

        public function loginMobile() {
            $email = $this->dados->email;
            $senha = $this->dados->senha;
            $usuario = UsuarioDAO::login($email, $senha);
            if ($usuario) {
                $usuario->setHash($email, $senha);
                $this->api->enviarResultado($usuario);
            } else {
                $this->api->enviarStatus(401);
            }
        }
    }
?>
