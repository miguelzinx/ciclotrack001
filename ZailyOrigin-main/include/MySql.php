<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = ""; // Defina a senha do seu banco de dados, se existir
$dbname = "zaily";

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
