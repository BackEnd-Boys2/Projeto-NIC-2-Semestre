<?php
    session_start();

    if(!isset($_SESSION["logado"]) || !$_SESSION["logado"]) {
        header("Location: login.php");
    }

    include_once "conexao_bd.php";

    $id = intval(htmlspecialchars($_GET["id"]));
    
    $sql = "SELECT * FROM projetos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $projeto = $stmt->fetch();
    
    $caminho_arquivo = "../" . $projeto["caminho_arquivo"];

    if (file_exists($caminho_arquivo)) {
        unlink($caminho_arquivo); // Apaga o arquivo
    }

    $sql = "DELETE FROM projetos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$id]);

    if($result) {
        echo "<h1>Projeto excluído com sucesso.</h1>";
    }
    else { 
        echo "<h1>Erro ao excluir o projeto.</h1>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
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
    <a href="../pagina_aluno.php">Clique aqui para voltar</a>
</body>
</html>