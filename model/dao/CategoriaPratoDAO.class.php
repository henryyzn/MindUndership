<?php
    require_once("Database.class.php");

    class CategoriaPratoDAO {
        public static function listar() {
            $categorias = array();
            $conn = Database::getConnection();
            $stmt = $conn->prepare("SELECT id, titulo, foto, ativo, id_categoria_parent AS parent FROM tbl_categoria ORDER BY id DESC");

            if ($stmt->execute()) {
                while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $categorias[] = new CategoriaPrato($rs);
                }
            }

            $conn = null;
            return $categorias;
        }

        public static function selecionar($id) {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("SELECT id, titulo, foto, ativo, id_categoria_parent AS parent FROM tbl_categoria WHERE id = ?");
            $stmt->bindParam(1, $id);

            $categoria = null;
            if ($stmt->execute()) {
                if ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $categoria = new CategoriaPrato($rs);
                }
            }

            $conn = null;
            return $categoria;
        }

        public static function inserir($categoria) {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("INSERT INTO tbl_categoria (titulo, foto, ativo, id_categoria_parent) VALUES (?, ?, ?, ?)");
            $stmt->bindValue(1, $categoria->getTitulo());
            $stmt->bindValue(2, $categoria->getFoto());
            $stmt->bindValue(3, $categoria->isAtivo(), PDO::PARAM_INT);
            $stmt->bindValue(4, filter_var($categoria->getParent(), FILTER_VALIDATE_INT) ? $categoria->getParent() : null);

            if ($stmt->execute()) {
                $categoria->setId($conn->lastInsertId());
            }

            $conn = null;
            return true;
        }

        public static function atualizar($id, $categoria) {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("UPDATE tbl_categoria SET titulo = ?, foto = ?, ativo = ?, id_categoria_parent = ? WHERE id = ?");
            $stmt->bindValue(1, $categoria->getTitulo());
            $stmt->bindValue(2, $categoria->getFoto());
            $stmt->bindValue(3, $categoria->isAtivo(), PDO::PARAM_INT);
            $stmt->bindValue(4, filter_var($categoria->getParent(), FILTER_VALIDATE_INT) ? $categoria->getParent() : null);
            $stmt->bindParam(5, $id);

            $resultado = $stmt->execute() ? $stmt->rowCount() : -1;
            $conn = null;
            return $resultado;
        }

        public static function ativar($id) {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("UPDATE tbl_categoria SET ativo = !ativo WHERE id = ?");
            $stmt->bindParam(1, $id);
            $resultado = $stmt->execute() ? $stmt->rowCount() : -1;
            $conn = null;
            return $resultado;
        }

        public static function excluir($id) {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("DELETE FROM tbl_categoria WHERE id = ?");
            $stmt->bindParam(1, $id);
            $resultado = $stmt->execute() ? $stmt->rowCount() : -1;
            $conn = null;
            return $resultado;
        }
    }
?>
