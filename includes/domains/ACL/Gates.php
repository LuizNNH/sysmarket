<?php 

@session_start();

if (!$_SESSION['user']['logado'] == true)
{
    header("Location: /login");
}

if (isset($_GET['id']) and $_GET['id'] == "logout")
{
    unset($_SESSION['user']['logado']);
    header("Location: /login");
}