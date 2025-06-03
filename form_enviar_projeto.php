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
    <title>Envio de Projetos</title>
    <link rel="stylesheet" href="css/style4.css">
</head>
<body>
    <section>
        <a id="returnLink" href="pagina_aluno.php"><svg viewBox="0 0 200 200" data-name="Layer 1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title></title><path d="M100,15a85,85,0,1,0,85,85A84.93,84.93,0,0,0,100,15Zm0,150a65,65,0,1,1,65-65A64.87,64.87,0,0,1,100,165ZM116.5,57.5a9.67,9.67,0,0,0-14,0L74,86a19.92,19.92,0,0,0,0,28.5L102.5,143a9.9,9.9,0,0,0,14-14l-28-29L117,71.5C120.5,68,120.5,61.5,116.5,57.5Z"></path></g></svg></a>
        <div class="area">
            <h1>Enviar Projeto</h1>
        <form action="backend/cadastrar_projeto.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="titulo" placeholder="Título do projeto" maxlength="80" autocomplete="off" required>
            <!--input type="text" name="link" placeholder="Link do projeto" required-->
            <input type="text" name="descricao" id="" placeholder="Descrição do projeto" maxlength="150" autocomplete="off" required>
            <input type="file" name="arquivo" accept=".pdf,.zip,.rar" required>

            <button type="submit">Enviar</button>
        </form>
            
        </div>
    </section>
</body>
</html>