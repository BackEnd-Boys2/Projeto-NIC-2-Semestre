<?php
    session_start();
    // Importa as configurações de conexão do banco de dados
    require_once 'conexao_bd.php'; 

    // Recebe os campos digitados no formulário de login
    $login = htmlspecialchars(trim($_POST["login"]));
    $senha = htmlspecialchars(trim($_POST["senha"]));
    // Criptografa a senha
    $senha_hash = hash('sha256', $senha);

    // Cria o comando de select e executa passando o login como parâmetro
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$login]);
    // Insere os valores recebidos na variavel usuário. Os valores serão listados como array associativo 
    $usuario = $stmt->fetch();

    // Se o usuário existir e a consulta tiver armazenado os valores, passa para a segunda verificação
    if($usuario) {
        // Se a senha digitada for igual a senha no banco de dados, inicia a sessão do usuário
        if($senha_hash === $usuario["senha"]) {
            
            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["is_adm"] = $usuario["is_adm"];
            $_SESSION["usuario"] = $usuario["nome"];
            $_SESSION["logado"] = true;
            
            if($usuario["is_adm"] === 1) {
                header("Location: ../pagina_professor.php");
            }
            else {
                header("Location: ../pagina_aluno.php");
            }
        }
        // Caso a senha esteja errada, retorna pra tela de login com uma mensagem
        else {
            $_SESSION["logado"] = false;
            $_SESSION["erro_login"] = 2;
            header("Location: ../login.php");
        }
    }
    // Caso o usuário não tenha sido encontrado, retorna pra tela de login com uma mensagem
    else {
        $_SESSION["logado"] = false;
        $_SESSION["erro_login"] = 1;
        header("Location: ../login.php");
    }
?>