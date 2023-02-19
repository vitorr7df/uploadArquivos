<?php
function conectaDB() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "imagens";

    // Cria a conexão
    $conn = new mysqli($servername, $username, $password, $db);
    $conn->query('SET SESSION wait_timeout = 288800');

    // Verifica se houve erro na conexão
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
?>