<?php

    require_once("Database.class.php");
    class CidadeDAO {
        public static function listar($idEstado){


            $lista = [];

            $conn = Database::getConnection();

            $stmt = $conn->prepare("select c.id, c.id_estado, c.cidade, e.estado
            FROM tbl_cidade as c
            INNER JOIN tbl_estado as e
            ON c.id_estado = e.id and e.id=?");
            //bindParamn -> parametro que substitui interrogação
            $stmt->bindParam(1, $idEstado);


            if($stmt->execute()){
                while ($resultado = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $listarCidade = new Cidade();
                    $listarCidade->setId($resultado['id']);
                    $listarCidade->setIdEstado($resultado['id_estado']);
                    $listarCidade->setCidade($resultado['cidade']);

                    $lista[] = $listarCidade;

                }
            }
            $conn = null;
            return $lista;
        }
    }
?>
