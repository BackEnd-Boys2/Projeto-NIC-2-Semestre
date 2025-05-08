<?php
  session_start();
  
  $usuario = ucfirst(strtolower($_SESSION["usuario"]));

  if(!isset($_SESSION["logado"]) || !$_SESSION["logado"]) {
    header("Location: login.php");
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <link rel="stylesheet" href="css/style4.css">
</head>
<body>
    
    <section>
        <h1>Poste aqui um projeto!<h1>
    <div class="area">
        <h2>Poste um Projeto</h2>
    <form action="backend/cadastrar_projeto.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="titulo" placeholder="Título do projeto" required>
        <!--input type="text" name="link" placeholder="Link do projeto" required-->
        <input type="text" name="descricao" id="" placeholder="Descricao do projeto" required>
        <input type="file" name="arquivo" accept=".pdf,.zip,.rar" required>

        <button type="submit">Enviar</button>
        </form>
        <p class="p1">Não tem uma conta?<br> Entre em contato com a coordenação</p>
        
    </div>
</section>
</body>
</html>