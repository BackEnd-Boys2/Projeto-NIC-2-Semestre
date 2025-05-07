<?php
    $host = 'localhost';
    $dbname = 'nic_bd';
    $usuario = 'admnicbd'; // padrão no XAMPP
    $senha = 'PhP@12345678900.';       // padrão é vazio

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Conexão bem-sucedida!";
    } catch (PDOException $e) {
        die("Erro na conexão: " . $e->getMessage());
    }
?>
