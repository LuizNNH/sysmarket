<?php 

@session_start();

if ($_SESSION['user']['logado'] != 1)
{
    header("Location: http://www.redirect.to.url.com/");

}