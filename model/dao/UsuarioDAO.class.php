<?php
    require_once("Database.class.php");

    class UsuarioDAO {
        public static function login($email, $senha) {
            $usuario = null;
            $conn = Database::getConnection();
            $stmt = $conn->prepare("SELECT id, nome, sobrenome, email FROM tbl_usuario WHERE email = ? AND senha = ?");
            $stmt->bindParam(1, $email);
            $stmt->bindValue(2, md5($senha));

            if ($stmt->execute()) {
                while ($rs = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $usuario = new Usuario($rs);
                }
            }

            $conn = null;
            return $usuario;
        }
    }
?>
