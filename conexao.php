<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:servidortcc0405.database.windows.net,1433; Database = fluxocaixa", "adm", "Senai260");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "adm", "pwd" => "{your_password_here}", "Database" => "fluxocaixa", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:servidortcc0405.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
?>
