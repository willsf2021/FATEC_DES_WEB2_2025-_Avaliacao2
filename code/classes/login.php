<?php
session_start();

/**
 * Classe responsável por gerenciar o login do usuário.
 */
class Login
{

    private $correctUsername = 'admin';
    private $correctPassword = 'admin';

    public function verificar_credenciais($username, $password)
    {
        if ($username == $this->correctUsername) {

            if ($password == $this->correctPassword) {

                $_SESSION["logged_in"] = TRUE;

                $_SESSION["username"] = $username;

                return true;
            }

            return false;
        }
    }

    public function verificar_logado()
    {
        if ($_SESSION["logged_in"] && $_SESSION["username"]) {
            return true;
        }
        $this->logout();
    }

    public function logout()
    {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
