<?php 
    session_start();
  
    $usuario = ucfirst(strtolower($_SESSION["usuario"]));

    if(!isset($_SESSION["logado"]) || !$_SESSION["logado"]) {
        header("Location: ../login.php");
    }
    
    require_once 'conexao_bd.php';

    $id = intval(htmlspecialchars($_POST["id"]));

    $sql = "SELECT * FROM projetos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $projeto = $stmt->fetch();
    
    $old_caminho_arquivo = "../" . $projeto["caminho_arquivo"];

    // Variaveis que vão receber o título e descrição do projeto
    $titulo =  htmlspecialchars(trim($_POST['titulo']));
    $descricao = htmlspecialchars(trim($_POST['descricao']));
    // Caminho onde o arquivo será guardado
    $diretorio = '../uploads/';

    // Se existir um arquivo e ele tiver sido recebido sem erros, renomeia e passa para a segunda validação
    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
        
        if (file_exists($old_caminho_arquivo)) {
            unlink($old_caminho_arquivo); // Apaga o arquivo
        }

        // Armazena o arquivo em uma variável temporária
        $arquivo_tmp = $_FILES['arquivo']['tmp_name'];

        // Extrai apenas o nome do arquivo, sem o caminho dele
        $nome_arquivo = basename($_FILES['arquivo']['name']);

        // Define o caminho do arquivo com uma chave unica para evitar que sejam inseridos projetos repetidos
        $caminho_arquivo = $diretorio . uniqid() . '_' . $nome_arquivo;

        // Se o arquivo tiver sido movido da pasta temporária para a pasta final, insere as informações no banco de dados
        if (move_uploaded_file($arquivo_tmp, $caminho_arquivo)) {
            // Cria o comando sql e prepara a conexão
            $sql = "UPDATE projetos SET nome = ?, descricao = ?, caminho_arquivo = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            // Executa o comando passando os valores a serem inseridos
            // O id do aluno dono do projeto será sempre o id do usuario logado
            $stmt->execute([$titulo, $descricao, str_replace('../', '',$caminho_arquivo), $id]);

            echo "<h1>Projeto atualizado com sucesso.</h1>";
        } else {
            echo "<h1>Erro ao mover o arquivo.</h1>";
        }
    }
    else {
        $sql = "UPDATE projetos SET nome = ?, descricao = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        // Executa o comando passando os valores a serem inseridos
        // O id do aluno dono do projeto será sempre o id do usuario logado
        $stmt->execute([$titulo, $descricao, $id]);

        echo "<h1>Informações do projeto atualizadas com sucesso.</h1>";
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
