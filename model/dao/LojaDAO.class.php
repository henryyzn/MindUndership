<?php

    //Em seguida após a class, vou para DAO
    //DAO -> Somente banco de dados

    require_once("Database.class.php");
    class LojaDAO {
        public static function inserir($loja) {
            $conn = Database::getConnection();

            $stmt = $conn->prepare("INSERT INTO tbl_endereco (id_cidade, logradouro, numero, bairro, cep, complemento) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bindParam(1, $loja->getIdCidade());
            $stmt->bindParam(2, $loja->getLogradouro());
            $stmt->bindParam(3, $loja->getNumero());
            $stmt->bindParam(4, $loja->getBairro());
            $stmt->bindParam(5, $loja->getCep());
            $stmt->bindParam(6, $loja->getComplemento());
            $stmt->execute();

            //lastInsertId ->Pega o último ultimo ID inserido (próprio do PHP)
            $idEndereco = $conn->lastInsertId();
            if ($idEndereco) {
                $stmt2 = $conn->prepare("INSERT INTO tbl_nossa_loja (id_endereco, latitude, longitude, funcionamento, ativo, telefone) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt2->bindParam(1, $idEndereco);
                $stmt2->bindParam(2, $loja->getLatitude());
                $stmt2->bindParam(3, $loja->getLongitude());
                $stmt2->bindParam(4, $loja->getFuncionamento());
                $stmt2->bindParam(5, $loja->getAtivo(), PDO::PARAM_INT);
                $stmt2->bindParam(6, $loja->getTelefone());
                $stmt2->execute();
            }

            $conn = null;
        }

        public static function listar() {
            $conn = Database::getConnection();
            $lojas = array();

            //Prepare -> Próprio PHP, vale igual ao prepare statatement
            $stmt = $conn->prepare("select l.*, e.logradouro, e.numero,
                e.bairro, e.cep, e.complemento,
                c.cidade, es.estado, es.UF as uf
                from tbl_nossa_loja as l
                inner join tbl_endereco as e on l.id_endereco = e.id
                inner join tbl_cidade as c on c.id = e.id_cidade
                inner join tbl_estado as es on c.id_estado = es.id");

            //stmt -> Steatement, coloca parametros dentro do SQL
            //:: -> Static
            if ($stmt->execute()) {
                while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $loja = new Loja($rs);
                    $lojas[] = $loja;
                }
            }

            $conn = null;
            return $lojas;
        }

        public static function excluir($id){
            $conn = Database::getConnection();

            $stmt = $conn->prepare("delete loja, endereco
            FROM tbl_nossa_loja as loja
            INNER JOIN tbl_endereco as endereco
            ON endereco.id = loja.id_endereco
            WHERE loja.id = ?");
            $stmt->bindParam(1, $id);
            $stmt->execute();

            $conn = null;

        }
        public static function ativar($id){
            $conn = Database::getConnection();
            $stmt = $conn->prepare("
            UPDATE tbl_nossa_loja SET ativo = !ativo WHERE id = ?");
            $stmt->bindParam(1, $id);
            $stmt->execute();

            $conn = null;
        }

        public static function editar($id, $informacao){
            $conn = Database::getConnection();
            $stmt = $conn->prepare("UPDATE tbl_nossa_Loja
            SET latitude = ?, longitude = ?, funcionamento = ?, telefone = ?
            WHERE id = ? ");

            $stmt->bindParam(1, $informacao->getLatitude());
            $stmt->bindParam(2, $informacao->getLongitude());
            $stmt->bindParam(3, $informacao->getFuncionamento());
            $stmt->bindParam(4, $informacao->getTelefone());
            $stmt->bindParam(5, $id);
            $stmt->execute();

            $stmt = $conn->prepare("UPDATE tbl_endereco
            SET id_cidade = ?, logradouro = ?, Numero = ?, Bairro = ?, cep = ?, complemento = ?
            WHERE id = ? ");

            $stmt->bindParam(1, $informacao->getIdCidade());
            $stmt->bindParam(2, $informacao->getLogradouro());
            $stmt->bindParam(3, $informacao->getNumero());
            $stmt->bindParam(4, $informacao->getBairro());
            $stmt->bindParam(5, $informacao->getCep());
            $stmt->bindParam(6, $informacao->getComplemento());
            $stmt->bindParam(7, $informacao->getIdEndereco());
            $stmt->execute();


            $conn = null;
        }

            public static function selecionar($id) {
            $loja = null;
            $conn = Database::getConnection();
            $stmt = $conn->prepare("select l.*, es.id as idEstado, e.logradouro, e.numero,
                e.bairro, e.cep, e.complemento, c.id as idCidade,
                c.cidade, es.estado,e.id as idEndereco, es.UF as uf
                from tbl_nossa_loja as l
                inner join tbl_endereco as e on l.id_endereco = e.id
                inner join tbl_cidade as c on c.id = e.id_cidade
                inner join tbl_estado as es on c.id_estado = es.id WHERE l.id = ?");

                $stmt->bindParam(1, $id);

                if ($stmt->execute()) {
                    if ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $loja = new Loja($rs);
                }
            }

                $conn = null;
                return $loja;
        }
    }
?>
