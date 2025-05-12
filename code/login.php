<?php
require('classes/login.php');

$validador = new Login();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);


    $message = 'Usuário ou senha incorreto(s)!';

    if ($validador->verificar_credenciais($username, $password)) {
        header("Location: home.php");
        exit();
    } else {
        header("Location: index.php?message=" . urlencode($message));
        exit();
    }
}
$validador->logout();
header("Location: index.php");
