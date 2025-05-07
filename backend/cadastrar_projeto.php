<?php 
    // Inicia as conexões de sessão e com o banco de dados
    session_start();
    require_once 'conexao_bd.php';

    // Variaveis que vão receber o título e descrição do projeto
    $titulo =  htmlspecialchars(trim($_POST['titulo']));
    $descricao = htmlspecialchars(trim($_POST['descricao']));
    // Caminho onde o arquivo será guardado
    $diretorio = '../uploads/';

    // Se existir um arquivo e ele tiver sido recebido sem erros, renomeia e passa para a segunda validação
    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
        
        // Armazena o arquivo em uma variável temporária
        $arquivo_tmp = $_FILES['arquivo']['tmp_name'];

        // Extrai apenas o nome do arquivo, sem o caminho dele
        $nome_arquivo = basename($_FILES['arquivo']['name']);

        // Define o caminho do arquivo com uma chave unica para evitar que sejam inseridos projetos repetidos
        $caminho_arquivo = $diretorio . uniqid() . '_' . $nome_arquivo;

        // Se o arquivo tiver sido movido da pasta temporária para a pasta final, insere as informações no banco de dados
        if (move_uploaded_file($arquivo_tmp, $caminho_arquivo)) {
            // Cria o comando sql e prepara a conexão
            $sql = "INSERT INTO projetos (nome, descricao, caminho_arquivo, id_aluno) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            // Executa o comando passando os valores a serem inseridos
            // O id do aluno dono do projeto será sempre o id do usuario logado
            $stmt->execute([$titulo, $descricao, $caminho_arquivo, $_SESSION["usuario_id"]]);

            echo "Projeto cadastrado com sucesso!";
        } else {
            echo "Erro ao mover o arquivo.";
    }
} else {
    echo "Arquivo não enviado ou com erro.";
}

    
?>