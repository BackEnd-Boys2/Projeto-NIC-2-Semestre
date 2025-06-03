<?php
    session_start();

    require_once 'backend/conexao_bd.php';

    $usuario = ucfirst(strtolower($_SESSION["usuario"]));

    if(!isset($_SESSION["logado"]) || !$_SESSION["logado"]) {
        header("Location: login.php");
    }

    $sql = "SELECT * FROM vw_consultar_projetos WHERE id_mentor = ? AND status = 'Em análise'";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_SESSION["usuario_id"]]);
    $projetos = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliar Projetos</title>
    <link href="css/style5.css" rel="stylesheet">
</head>
<body>
    <main>
        <a id="returnLink" href="pagina_professor.php"><svg viewBox="0 0 200 200" data-name="Layer 1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title></title><path d="M100,15a85,85,0,1,0,85,85A84.93,84.93,0,0,0,100,15Zm0,150a65,65,0,1,1,65-65A64.87,64.87,0,0,1,100,165ZM116.5,57.5a9.67,9.67,0,0,0-14,0L74,86a19.92,19.92,0,0,0,0,28.5L102.5,143a9.9,9.9,0,0,0,14-14l-28-29L117,71.5C120.5,68,120.5,61.5,116.5,57.5Z"></path></g></svg></a>
        <h1>Avaliar Projetos</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tema do Projeto</th>
                    <th>Descrição</th>
                    <th>Aluno</th>
                    <th>Data de Envio</th>
                    <th>Arquivo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="tabela-corpo">
                <?php foreach($projetos as $projeto) { ?>
                    <tr>
                        <td><?= $projeto["id"]; ?></td>
                        <td><?= $projeto["nome"]; ?></td>
                        <td><?= $projeto["descricao"]; ?></td>
                        <td><?= $projeto["nome_aluno"] ?></td>
                        <td><?= $projeto["data_formatada"]; ?></td>
                        <td><a href="<?= $projeto["caminho_arquivo"]; ?>" download="<?= preg_replace('/^[^_]+_/', '', basename($projeto["caminho_arquivo"])); ?>">Baixar</a></td>
                        <td><a href="backend/avaliar_projeto.php?id=<?= $projeto["id"]; ?>&acao=Aprovado">Aprovar ✅</a> | <a href="backend/avaliar_projeto.php?id=<?= $projeto["id"]; ?>&acao=Reprovado">Reprovar ❌</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php
            if(!$projetos) {
                echo "<h2 class='error'>Você ainda não atribuiu nenhum projeto.</h2>";
            }
        ?>
    </main>
</body>
</html>