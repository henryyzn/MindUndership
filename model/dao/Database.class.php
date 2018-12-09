<?php
    /* Classe responsável por montar conexões com o banco de dados */
    class Database {
        /* Atributos de conexão */
        //private static $HOST = "10.107.144.250";
        private static $HOST = "127.0.0.1";
        private static $USUARIO = "root";
        private static $SENHA = "bcd127";
        //private static $SENHA = "";
        private static $DB = "db_food4fit";
        /* Define que o método "rowsCount()" do PDO irá retornar o número de linhas encontradas, e não o número de linhas alteradas, garantindo que o usuário não receba um erro caso um UPDATE não faça nenhuma alteração */
        private static $CONFIG = array(
            PDO::MYSQL_ATTR_FOUND_ROWS => true
        );

        /*
        * Retorna uma conexão com o banco de dados
        * @return PDO objeto para acesso do banco de dados caso a conexão seja feita com sucesso
        * @return JSON se a conexão não poder ser efetuada
        */
        public static function getConnection() {
            try {
                $conn = new PDO("mysql:host=" . Database::$HOST . ";dbname=" . Database::$DB . ";charset=utf8", Database::$USUARIO, Database::$SENHA, Database::$CONFIG);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $conn->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
                return $conn;

            } catch (PDOException $erro) {
                header("HTTP/1.1 500 Internal Server Error");
                die(json_encode(array("result" => $erro->getMessage())));
            }
        }
    }
?>
