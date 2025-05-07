<?php
    session_start();

    // Opção mais leve: limpa as variaveis de sessão
    $_SESSION = array();
    $_SESSION["logado"] = false;
    header("Location: ../login.php");
?>