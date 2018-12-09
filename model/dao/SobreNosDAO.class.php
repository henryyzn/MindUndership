<?php
    require_once("Database.class.php");

    class SobreNosDAO {
        public static function listar() {
            $itens = array();
            $conn = Database::getConnection();
            $stmt = $conn->prepare("SELECT * FROM tbl_sobre_empresa ORDER BY id DESC");

            if ($stmt->execute()) {
                while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $itens[] = new ItemSobreNos($rs);
                }
            }

            $conn = null;
            return $itens;
        }

        public static function selecionar($id) {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("SELECT * FROM tbl_sobre_empresa WHERE id = ?");
            $stmt->bindParam(1, $id);

            $item = null;
            if ($stmt->execute()) {
                if ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $item = new ItemSobreNos($rs);
                }
            }

            $conn = null;
            return $item;
        }

        public static function inserir($item) {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("INSERT INTO tbl_sobre_empresa (titulo, texto, foto, ativo) VALUES (?, ?, ?, ?)");
            $stmt->bindValue(1, $item->getTitulo());
            $stmt->bindValue(2, $item->getTexto());
            $stmt->bindValue(3, $item->getFoto());
            $stmt->bindValue(4, $item->isAtivo(), PDO::PARAM_INT);

            if ($stmt->execute()) {
                $item->setId($conn->lastInsertId());
                $item->setAtivo(true);
            }

            $conn = null;
            return true;
        }

        public static function atualizar($id, $item) {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("UPDATE tbl_sobre_empresa SET titulo = ?, texto = ?, foto = ? WHERE id = ?");
            $stmt->bindValue(1, $item->getTitulo());
            $stmt->bindValue(2, $item->getTexto());
            $stmt->bindValue(3, $item->getFoto());
            $stmt->bindParam(4, $id);
            $resultado = $stmt->execute() ? $stmt->rowCount() : -1;
            $conn = null;
            return $resultado;
        }

        public static function ativar($id) {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("UPDATE tbl_sobre_empresa SET ativo = !ativo WHERE id = ?");
            $stmt->bindParam(1, $id);
            $resultado = $stmt->execute() ? $stmt->rowCount() : -1;
            $conn = null;
            return $resultado;
        }

        public static function excluir($id) {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("DELETE FROM tbl_sobre_empresa WHERE id = ?");
            $stmt->bindParam(1, $id);
            $resultado = $stmt->execute() ? $stmt->rowCount() : -1;
            $conn = null;
            return $resultado;
        }
    }
?>
