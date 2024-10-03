<?php
session_start(); // Iniciar a sessão
include "layout/header/header.php";
include "../include/MySql.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha']; // Use 'senha' aqui

    // Verifica se a conexão foi estabelecida corretamente
    if ($conn) {
        // Prepare a consulta para verificar o usuário
        $stmt = $conn->prepare("SELECT idUsuario, nmUsuario, senha FROM usuario WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // Verifica se o usuário foi encontrado
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($idUsuario, $nmUsuario, $hashed_senha);
            $stmt->fetch();

            // Verifica se a senha está correta
            if (password_verify($senha, $hashed_senha)) {
                $_SESSION['idUsuario'] = $idUsuario;
                $_SESSION['email'] = $email;
                $_SESSION['nmUsuario'] = $nmUsuario;

                // Redireciona o usuário para a página principal
                header("Location: index.php");
                exit();
            } else {
                echo "Senha incorreta!";
            }
        } else {
            echo "Usuário não encontrado!";
        }

        $stmt->close();
    } else {
        echo "Erro na conexão com o banco de dados.";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CicloTrack | Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <form action="login.php" method="post">
        <div class="main-login">
            <div class="left-login">
                <h1>Faça login<br>E entre para o nosso time!</h1>
            </div>
            <div class="right-login">
                <div class="card-login">
                    <h1 class="titleFormLogin">Login</h1>
                    <div class="textfield">
                        <input type="email" name="email" placeholder="Usuário" required>
                    </div>
                    <div class="textfield">
                        <input type="password" name="senha" placeholder="Senha" required> <!-- 'senha' no input -->
                    </div>
                    <a href="cadastro.php" class="LinkCadastroLogin">Não é membro? Cadastre-se</a>
                    <button type="submit" class="btn-login">Enviar</button>
                </div>
            </div>
        </div>
    </form>
    <script src="assets/js/index.js"></script>
</body>
</html>
