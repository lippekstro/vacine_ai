
<?php
require_once __DIR__ . "/../configs/conexao.php";

class Autenticacao
{
    private const TEMPO_EXPIRACAO = 900; // 15 minutos

    public static function login($email, $senha)
    {
        self::iniciarSessao();

        $sql = "SELECT * FROM usuario WHERE email=:email";

        $con = Conexao::conectar();
        $stmt = $con->prepare($sql);

        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $resultado = $stmt->fetch();

        if ($resultado && password_verify($senha, $resultado["senha"])) {

            session_regenerate_id(true);

            $_SESSION['id_usuario'] = $resultado['id_usuario'];
            $_SESSION['nome'] = $resultado['nome'];
            $_SESSION['nivel'] = $resultado['nivel_acesso'];

            $_SESSION['ultima_atividade'] = time();

            header('Location: /vacine_ai/views/perfil.php');
            exit();
        } else {
            $_SESSION['tipo_alerta'] = 'danger';
            $_SESSION['alerta_msg'] = 'Conta não existe!';

            header('Location: /vacine_ai/views/login.php');
            exit;
        }
    }

    public static function isLogado()
    {
        self::iniciarSessao();

        return isset($_SESSION['id_usuario']);
    }

    public static function isAdmin()
    {
        self::iniciarSessao();

        return isset($_SESSION['nivel']) && $_SESSION['nivel'] == 2;
    }

    public static function iniciarSessao()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['id_usuario'])) {

            // Verifica se a sessão expirou
            if (
                isset($_SESSION['ultima_atividade']) &&
                (time() - $_SESSION['ultima_atividade']) > self::TEMPO_EXPIRACAO
            ) {
                self::logout();
            }

            // Atualiza a última atividade
            $_SESSION['ultima_atividade'] = time();
        }
    }

    public static function logout()
    {
        // Não chamar iniciarSessao() aqui!

        $_SESSION = [];

        // Remove o cookie da sessão
        if (ini_get("session.use_cookies")) {

            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();

        header('Location: /vacine_ai/views/login.php');
        exit();
    }
}
