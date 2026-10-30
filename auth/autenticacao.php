<?php
require_once __DIR__ . "/../configs/conexao.php";

class Autenticacao
{
    public static function login($email, $senha)
    {
        self::iniciarSessao();
        $sql = "SELECT * FROM usuario WHERE email=:email";
        $con = Conexao::conectar();
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $resultado = $stmt->fetch();

        if ($resultado && password_verify($resultado["senha"], $senha)) {
            $_SESSION['id_usuario'] = $resultado['id_usuario'];
            $_SESSION['nome'] = $resultado['nome'];
            $_SESSION['nivel'] = $resultado['nivel_acesso'];

            header('Location: /vacine_ai/views/perfil.php');
            exit();
        }
    }

    public static function isLogado()
    {
        self::iniciarSessao();

        return (isset($_SESSION['id_usuario']));
    }

    public static function isAdmin()
    {
        self::iniciarSessao();
        return ($_SESSION['nivel'] == 2);
    }

    public static function iniciarSessao()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function logout() {
        self::iniciarSessao();
        $_SESSION = [];
        session_destroy();

        header('Location: /vacine_ai/views/login.php');
        exit();
    }
}
