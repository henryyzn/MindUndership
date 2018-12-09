<?php
    require_once("Database.class.php");

    class UnidadeMedidaDAO {
        public static function listar() {
            $unidades = array();
            $conn = Database::getConnection();
            $stmt = $conn->prepare("SELECT id, sigla, unid_medida AS unidade_medida FROM tbl_unidade_medida");

            if ($stmt->execute()) {
                while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $unidades[] = new UnidadeMedida($rs);
                }
            }

            $conn = null;
            return $unidades;
        }
    }
?>
