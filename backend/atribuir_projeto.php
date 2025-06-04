<?php 
    session_start();
  
    $usuario = ucfirst(strtolower($_SESSION["usuario"]));

    if(!isset($_SESSION["logado"]) || !$_SESSION["logado"]) {
        header("Location: ../login.php");
    }
    
    require_once 'conexao_bd.php';

    $id = intval(htmlspecialchars($_GET["id"]));

    $sql = "UPDATE projetos SET id_mentor = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    // Executa o comando passando os valores a serem inseridos
    // O id do aluno dono do projeto será sempre o id do usuario logado
    $result = $stmt->execute([$_SESSION["usuario_id"], $id]);

    if($result) {
        echo "<h1>Projeto atribuido com sucesso.</h1>";
    }
    else {
        echo "<h1>Erro ao atribuir o projeto.</h1>";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atribuir Mentoria</title>
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