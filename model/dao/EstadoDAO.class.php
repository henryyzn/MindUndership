<?php

    //PDO -> Classe do PHP chamando banco de dados em Orientação a objeto
    //Primeiro CRIA o objeto e DEPOIS INSERE ELA NA LISTA
    require_once("Database.class.php");
    class EstadoDAO {
        public static function listar(){

            $lista = [];

            $conn = Database::getConnection();

            $stmt = $conn->prepare("SELECT * FROM tbl_estado");

            if($stmt->execute()){
                while ($resultado = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $listarEstado = new Estado();
                    $listarEstado->setId($resultado['id']);
                    $listarEstado->setEstado($resultado['estado']);
                    $listarEstado->setUf($resultado['UF']);

                    $lista[] = $listarEstado;
                }
            }
            $conn = null;
            return $lista;
        }
    }
?>
