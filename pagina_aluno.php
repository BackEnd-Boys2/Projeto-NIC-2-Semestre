<?php
  session_start();
  
  $usuario = ucfirst(strtolower($_SESSION["usuario"]));

  if(!isset($_SESSION["logado"]) || !$_SESSION["logado"]) {
    header("Location: login.php");
  }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Navbar e Projeto</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Cores da Fatec - CPS */
    body {
      background-color: #ffffff;
      color: #333333;
    }
    .navbar-custom {
      background-color: #9d0b0e; /* Vermelho Fatec */
    }
    .descricao {
      background-color: #ededed; /* Cinza claro Fatec */
      min-height: 90vh; /* 90% da altura da tela */
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 2rem;
    }
    .descricao h1 {
      color: #9d0b0e;
    }
    .descricao p {
      font-size: 1.2rem;
      max-width: 800px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom">
  <div class="container-fluid">
    <a class="navbar-brand text-white" href="#">Bem vindo(a), <?= $usuario; ?></a>
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link text-white" href="enviar_projeto.php">Enviar Projeto</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="#">Solicitações</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="backend/logout.php">Deslogar</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Descrição do Projeto -->
<section class="descricao">
  <h1>Bem-vindo ao Portal de Projetos Fatec - CPS</h1>
  <p>
    Este portal foi desenvolvido para facilitar o envio, acompanhamento e gerenciamento de projetos acadêmicos
    da Fatec, integrando alunos e professores em um ambiente moderno e intuitivo. Aqui você poderá submeter
    seus trabalhos, acompanhar solicitações e manter sua jornada acadêmica organizada.
  </p>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
