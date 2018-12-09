<?php
    require_once("Database.class.php");

    class IngredienteDAO {
        public static function listar() {
            $ingredientes = array();
            $conn = Database::getConnection();
            $stmt = $conn->prepare("SELECT i.*, i.valor_energ AS valor_energetico, u.id AS `unidadeMedida.id`, u.unid_medida AS `unidadeMedida.unidadeMedida`, u.sigla AS `unidadeMedida.sigla`, c.id AS `categoria.id`, c.titulo AS `categoria.titulo` FROM tbl_ingrediente AS i INNER JOIN tbl_unidade_medida AS u ON u.id = i.id_unidade_medida INNER JOIN tbl_categoria_ingrediente AS c ON c.id = i.id_categoria_ingrediente ORDER BY i.id DESC");

            if ($stmt->execute()) {
                while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $ingredientes[] = new Ingrediente($rs);
                }
            }

            $conn = null;
            return $ingredientes;
        }

        public static function selecionar($id) {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("SELECT i.*, i.valor_energ AS valor_energetico, u.id AS `unidadeMedida.id`, u.unid_medida AS `unidadeMedida.unidadeMedida`, u.sigla AS `unidadeMedida.sigla`, c.id AS `categoria.id`, c.titulo AS `categoria.titulo` FROM tbl_ingrediente AS i INNER JOIN tbl_unidade_medida AS u ON u.id = i.id_unidade_medida INNER JOIN tbl_categoria_ingrediente AS c ON c.id = i.id_categoria_ingrediente WHERE i.id = ?");
            $stmt->bindParam(1, $id);

            $ingrediente = null;
            if ($stmt->execute()) {
                if ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $ingrediente = new Ingrediente($rs);
                }
            }

            $conn = null;
            return $ingrediente;
        }

        public static function inserir($ingrediente) {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("INSERT INTO tbl_ingrediente (id_categoria_ingrediente, id_unidade_medida, titulo, descricao, preco, valor_energ, carboidratos, proteinas, gordura_total, gordura_saturada, gordura_trans, fibra_alimentar, sodio, foto, ativo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $ingrediente->getCategoria()->getId());
            $stmt->bindValue(2, $ingrediente->getUnidadeMedida()->getId());
            $stmt->bindValue(3, $ingrediente->getTitulo());
            $stmt->bindValue(4, $ingrediente->getDescricao());
            $stmt->bindValue(5, $ingrediente->getPreco());
            $stmt->bindValue(6, $ingrediente->getValorEnergetico());
            $stmt->bindValue(7, $ingrediente->getCarboidratos());
            $stmt->bindValue(8, $ingrediente->getProteinas());
            $stmt->bindValue(9, $ingrediente->getGorduraTotal());
            $stmt->bindValue(10, $ingrediente->getGorduraSaturada());
            $stmt->bindValue(11, $ingrediente->getGorduraTrans());
            $stmt->bindValue(12, $ingrediente->getFibraAlimentar());
            $stmt->bindValue(13, $ingrediente->getSodio());
            $stmt->bindValue(14, $ingrediente->getFoto());
            $stmt->bindValue(15, $ingrediente->isAtivo(), PDO::PARAM_INT);

            $resultado = null;
            if ($stmt->execute()) {
                $resultado = IngredienteDAO::selecionar($conn->lastInsertId());
            }

            $conn = null;
            return $resultado;
        }

        public static function atualizar($id, $ingrediente) {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("UPDATE tbl_ingrediente SET id_categoria_ingrediente = ?, id_unidade_medida = ?, titulo = ?, descricao = ?, preco = ?, valor_energ = ?, carboidratos = ?, proteinas = ?, gordura_total = ?, gordura_saturada = ?, gordura_trans = ?, fibra_alimentar = ?, sodio = ?, foto = ?, ativo = ? WHERE id = ?");
            $stmt->bindValue(1, $ingrediente->getCategoria()->getId());
            $stmt->bindValue(2, $ingrediente->getUnidadeMedida()->getId());
            $stmt->bindValue(3, $ingrediente->getTitulo());
            $stmt->bindValue(4, $ingrediente->getDescricao());
            $stmt->bindValue(5, $ingrediente->getPreco());
            $stmt->bindValue(6, $ingrediente->getValorEnergetico());
            $stmt->bindValue(7, $ingrediente->getCarboidratos());
            $stmt->bindValue(8, $ingrediente->getProteinas());
            $stmt->bindValue(9, $ingrediente->getGorduraTotal());
            $stmt->bindValue(10, $ingrediente->getGorduraSaturada());
            $stmt->bindValue(11, $ingrediente->getGorduraTrans());
            $stmt->bindValue(12, $ingrediente->getFibraAlimentar());
            $stmt->bindValue(13, $ingrediente->getSodio());
            $stmt->bindValue(14, $ingrediente->getFoto());
            $stmt->bindValue(15, $ingrediente->isAtivo(), PDO::PARAM_INT);
            $stmt->bindParam(16, $id);

            $resultado = $stmt->execute() ? $stmt->rowCount() : -1;
            $conn = null;
            if ($resultado) {
                return IngredienteDAO::selecionar($id);
            } else {
                return $resultado;
            }
        }

        public static function ativar($id) {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("UPDATE tbl_ingrediente SET ativo = !ativo WHERE id = ?");
            $stmt->bindParam(1, $id);
            $resultado = $stmt->execute() ? $stmt->rowCount() : -1;
            $conn = null;
            return $resultado;
        }

        public static function excluir($id) {
            $conn = Database::getConnection();
            $stmt = $conn->prepare("DELETE FROM tbl_ingrediente WHERE id = ?");
            $stmt->bindParam(1, $id);
            $resultado = $stmt->execute() ? $stmt->rowCount() : -1;
            $conn = null;
            return $resultado;
        }
    }
?>
