<?php
    session_start();
    // Importa as configurações de conexão do banco de dados
    require_once 'conexao_bd.php'; 

    // Recebe os campos digitados no formulário de login
    $login = htmlspecialchars(trim($_POST["login"]));
    $senha = htmlspecialchars(trim($_POST["senha"]));
    // Criptografa a senha
    $senha_hash = hash('sha256', $senha);

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$login]);
    $usuario = $stmt->fetch();

    if($usuario) {
        if($senha_hash === $usuario["senha"]) {
            
            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["is_adm"] = $usuario["is_adm"];
            $_SESSION["usuario"] = $usuario["nome"];
            $_SESSION["logado"] = true;
            
            if($usuario["is_adm"] === 1) {
                header("Location: ../pagina_professor.html");
            }
            else {
                header("Location: ../pagina_aluno.php");
            }
            
        } else {
            // Senha incorreta
            $_SESSION["logado"] = false;
            $_SESSION["erro_login"] = 2;
            header("Location: ../login.php");
        }
    } else {
        // Login incorreto
        $_SESSION["logado"] = false;
        $_SESSION["erro_login"] = 1;
        header("Location: ../login.php");
        echo "<br>";
        echo "erro";
    }
?>