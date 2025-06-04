<?php
    session_start();

    require_once 'conexao_bd.php';

    $usuario = ucfirst(strtolower($_SESSION["usuario"]));

    if(!isset($_SESSION["logado"]) || !$_SESSION["logado"]) {
        header("Location: ../login.php");
    }

    $id = intval(htmlspecialchars($_GET["id"]));
    $acao = htmlspecialchars(trim($_GET["acao"]));

    $sql = "SELECT * FROM projetos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $projeto = $stmt->fetch();

    if($projeto) {
        if($projeto["status"] !== "Em análise") {
            header("Location: ../listar_projetos.php");
        }
        elseif($acao == "Aprovado" || $acao == "Reprovado") {
            $sql = "UPDATE projetos SET status = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([$acao, $id]);
        }

        if($result) {
            echo "<h1>Projeto ". strtolower($acao) . " com sucesso.</h1>";
        }
        else {
            echo "<h1>Ocorreu um erro ao avaliar o projeto.</h1>";
        }
    }
    else {
        echo "<h1>Ocorreu um erro ao avaliar o projeto.</h1>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliar Projeto</title>
    <style>
        body {
            background-color: #F2F2F2;
            height: 100%;
            display: flex;
            flex-flow: column nowrap;
            justify-content: center;
            align-items: center;
        }
        h1 {
            color: #000;
        }
        a, a:visited {
            color: #990000;
            text-decoration: none;
            transition: 0.2s ease-in-out;
        }
        a:hover {
            color:#f00;
        }
    </style>
</head>
<body>
    <a href="../pagina_professor.php">Clique aqui para voltar</a>
</body>
</html>