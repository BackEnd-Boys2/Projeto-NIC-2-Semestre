<?php
    // Inclui a biblioteca
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    require "conexao_bd.php";
    require "../phpmailer/PHPMailer.php";
    require "../phpmailer/SMTP.php";
    require "../phpmailer/Exception.php";

    $destinatario = htmlspecialchars(trim($_POST["email"]));

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$destinatario]);
    // Insere os valores recebidos na variavel usuário. Os valores serão listados como array associativo 
    $usuario = $stmt->fetch();

    if (!$usuario) {
        echo "Usuário não encontrado no banco de dados.";
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nome = ucfirst(strtolower($usuario["nome"]));
        $remetente = "fatecnicmarilia@gmail.com";
        $rem_nome ="Núcleo de Iniciação Científica - Fatec Marília";
        
        $mail = new PHPMailer(true);
        
        try {
        // Configurações do servidor SMTP (exemplo com Gmail)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';          // Servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = $remetente;  // Seu e-mail Gmail
        $mail->Password = "PhP@12345678900";            // Sua senha (use App Password)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;               // Segurança TLS
        $mail->Port = 587;

         // Remetente
        $mail->setFrom($remetente, $rem_nome);

        // Destinatário
        $mail->addAddress($destinatario, $nome);
        // Assunto e corpo
        $mail->Subject = 'Confirmação de Inscrição';
        $mail->isHTML(true); // Ativa HTML

        $mail->Body = "
            <h2>Olá, $nome!</h2>
            <p>Sua inscrição foi realizada com sucesso.</p>
            <p>A sua senha é a mesma utilizada no <strong>SIGA</strong></p>
            <p><a href='../login.php'>Clique aqui para acessar a página de Iniciação Científica</a>.</p>
        ";

        // Envia o e-mail
        $mail->send();
        echo "E-mail de confirmação enviado com sucesso!";
    } catch (Exception $e) {
        echo "Erro ao enviar o e-mail: {$mail->ErrorInfo}";
    }
}

?>