<?php
$server = "servidortcc0405.database.windows.net";
$user = "adm";
$password = "Senai260";
$bd = "fluxocaixa";

try {
    $conn = new PDO("mysql:host=$server;dbname=$bd", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
