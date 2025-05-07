<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Fatec</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Roboto', sans-serif;
      background: #f2f2f2;
      height: 100vh;
      display: flex;
      flex-flow: column nowrap;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      background-color: white;
      padding: 40px 30px;
      border-radius: 10px;
      box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    .login-container h1 {
      margin-bottom: 20px;
      color: #990000;
      font-size: 26px;
      font-weight: 700;
    }

    .login-container form {
      display: flex;
      flex-direction: column;
    }

    .login-container input[type="email"],
    .login-container input[type="password"] {
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    .login-container button {
      margin-top: 20px;
      padding: 12px;
      background-color: #990000;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s;
    }

    .login-container button:hover {
      background-color: #660000;
    }

    .login-container p {
      margin-top: 20px;
      font-size: 14px;
      color: #4d4d4d;
    }

    .login-container a {
      color: #990000;
      text-decoration: none;
      font-weight: bold;
    }

    .login-container a:hover {
      text-decoration: underline;
    }

    #alertaErro {
      width: 30%;
      text-align: center;
      margin: 0 auto;
    }
  </style>
</head>

<body>

<div class="login-container">
  <h1>Login Fatec</h1>
  <form method="POST" action="backend/validar_login.php" onsubmit="return validarFormulario()">
    <input type="email" name="login" id="login" placeholder="Usuário" required autocomplete="off"x'>
    <input type="password" name="senha" id="senha" placeholder="Senha" required>
    <button type="submit">Entrar</button>
  </form>
  <p>Esqueceu sua senha? <a href="#">Recuperar</a></p>
  
</div>

<div class="container mt-3">
  <div id="alertaErro" class="alert alert-danger alert-dismissible fade show d-none fixed-bottom mb-5" role="alert">
    Usuário ou senha incorretos.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
  </div>
</div>

<?php 
  // Se existir uma variável de login e ela for false
  if(isset($_SESSION["logado"]) && !$_SESSION["logado"]) {
    // Se o erro de login for igual a 1 (erro de usuário)
      if($_SESSION["erro_login"] == 1) { ?>
        <script>
          window.addEventListener('DOMContentLoaded', () => {
            exibirAlerta(1);
          });
        </script>
<?php } if($_SESSION["erro_login"] == 2) { ?>
          <script>
            window.addEventListener('DOMContentLoaded', () => {
              exibirAlerta(2);
            });
          </script>
<?php } else { ?>
          <script>
            window.addEventListener('DOMContentLoaded', () => {
              exibirAlerta(3);
            });
          </script>
<?php }
    } 
?>
  


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>

  function exibirAlerta(v) {
    const alerta = document.getElementById('alertaErro');

    switch(v) {
      case 1:
        alerta.textContent = "Usuário incorreto.";
        break;

      case 2:
        alerta.textContent = "Senha incorreta.";
        break;

        case 3:
        alerta.textContent = "Usuário e senha incorretas.";
        break;

        default:
        alerta.textContent = "Erro desconhecido.";
        break;
    }

    alerta.classList.remove('d-none');

    // Remove o alerta após 3 segundos
    setTimeout(() => {
      alerta.classList.add('d-none');
    }, 3000);
  }

  function validarFormulario() {
    let login = document.getElementById("login").value.trim();
    let senha = document.getElementById("senha").value;
  
    // Validação: formato de e-mail com expressão regular básica
  const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(login);
  if (!emailValido) {
    alert("Digite um e-mail válido.");
    return false;
  }

  // Validação: senha deve ter no mínimo 6 caracteres
  if (password.length < 6) {
    alert("A senha deve ter pelo menos 6 caracteres.");
    return false;
  }
  
    return true; // Permite o envio do formulário
  }
  </script>
</body>
</html>
