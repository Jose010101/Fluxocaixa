<?php
$server = "localhost";
$user = "root";
$password = "";
$bd = "fluxocaixa";

try {
    $conn = new PDO("mysql:host=$server;dbname=$bd", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>