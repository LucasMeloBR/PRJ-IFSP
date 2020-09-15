<?php

    // Arquivo comum de conexão com o Banco de dados 
    require("common.php");

    unset($_SESSION['user']);

    $_SESSION = array();

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Terminar a sessão
    session_destroy();

    header("Location: index.html");
    die("Redirecting to: index.html");