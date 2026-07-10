<?php
// Permite que o Wokwi acesse a página sem problemas de CORS
header("Access-Control-Allow-Origin: *");

$filename = "led_status.txt";

// Se não existir o arquivo, cria com o LED desligado (0)
if (!file_exists($filename)) {
    file_put_contents($filename, "0");
}

// 1. Processa o clique dos botões no site
if (isset($_GET['status'])) {
    $status = $_GET['status'] == '1' ? '1' : '0';
    file_put_contents($filename, $status);
    header("Location: index.php"); // Recarrega a página para limpar a URL
    exit;
}

// 2. Responde ao ESP32 (Se a requisição pedir formato texto/json)
if (isset($_GET['api'])) {
    echo file_get_contents($filename);
    exit;
}

// Lê o status atual para mostrar na tela
$status_atual = file_get_contents($filename);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Controle do LED - ESP32</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .btn { padding: 15px 30px; font-size: 18px; margin: 10px; cursor: pointer; border: none; border-radius: 5px; }
        .on { background-color: #4CAF50; color: white; }
        .off { background-color: #f44336; color: white; }
    </style>
</head>
<body>
    <h1>Controle do LED Remoto</h1>
    <p>O LED está atualmente: <strong><?php echo $status_atual == '1' ? 'LIGADO' : 'DESLIGADO'; ?></strong></p>
    
    <a href="index.php?status=1"><button class="btn on">Ligar LED</button></a>
    <a href="index.php?status=0"><button class="btn off">Desligar LED</button></a>
</body>
</html>
