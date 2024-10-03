<?php
include "../include/MySql.php"; // Certifique-se de que este arquivo contém a conexão correta com o banco de dados.

$nmUsuario = $email = $genero = $senha = $dtNasc = $confSenha = "";
$nmUsuarioErro = $emailErro = $generoErro = $senhaErro = $dtNascErro = $confSenhaErro = $msgErro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validação dos campos
    if (empty($_POST['nmUsuario'])) {
        $nmUsuarioErro = "Nome é obrigatório!";
    } else {
        $nmUsuario = $_POST['nmUsuario'];
    }

    if (empty($_POST['email'])) {
        $emailErro = "Email é obrigatório!";
    } else {
        $email = $_POST['email'];
    }

    if (empty($_POST['genero'])) {
        $generoErro = "Gênero é obrigatório!";
    } else {
        $genero = $_POST['genero'];
    }

    if (empty($_POST['senha'])) {
        $senhaErro = "Senha é obrigatória!";
    } else {
        $senha = $_POST['senha'];
    }

    if (empty($_POST['dtNasc'])) {
        $dtNascErro = "Data de nascimento é obrigatória!";
    } else {
        $dtNasc = $_POST['dtNasc'];
    }

    if (empty($_POST['confSenha'])) {
        $confSenhaErro = "Confirmação de senha é obrigatória!";
    } else {
        $confSenha = $_POST['confSenha'];
    }

    // Verificação de todos os campos preenchidos
    if ($nmUsuario && $email && $genero && $senha && $dtNasc && $confSenha) {
        if ($senha !== $confSenha) {
            $msgErro = "As senhas não correspondem!";
        } else {
            // Inserção no banco de dados
            $sql = $conn->prepare("INSERT INTO usuario (nmUsuario, email, genero, senha, dtNasc) VALUES (?, ?, ?, ?, ?)");
            $hashedPassword = password_hash($senha, PASSWORD_DEFAULT);
            
            if ($sql) {
                $sql->bind_param("sssss", $nmUsuario, $email, $genero, $hashedPassword, $dtNasc);
                if ($sql->execute()) {
                    echo "Dados cadastrados com sucesso!";
                    header('location: login.php');
                    exit();
                } else {
                    echo "Erro ao cadastrar: " . $sql->error;
                }
            } else {
                echo "Erro ao preparar a consulta: " . $conn->error;
            }
        }
    } else {
        $msgErro = "Todos os campos são obrigatórios!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Zaily | Cadastro </title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <section class="main-cadastro">
        <div class="box">
            <div class="img-box">
                <img src="assets/img/png/ImgTelaCadastro.png">
            </div>
            <div class="form-box">
                <h2><a href="cadastro.php" class="LinkTitleCadastro">Criar Conta</a></h2>
                <p class="PCadastro"> Já é um membro? Faça <a href="login.php" class="a-LinkCadastro"> Login </a> </p>
                <form method="POST">
                    <div class="input-group">
                        <label for="nome" class="LabelCadastro"> Nome Completo</label>
                        <input type="text" id="nome" name="nmUsuario" placeholder="Digite o seu nome completo" value="<?php echo $nmUsuario; ?>" required>
                        <span class="obrigatorio">*<?php echo $nmUsuarioErro ?></span>
                    </div>

                    <div class="input-group">
                        <label for="email" class="LabelCadastro">E-mail</label>
                        <input type="email" id="email" name="email" placeholder="Digite o seu email" value="<?php echo $email; ?>" required>
                        <span class="obrigatorio">*<?php echo $emailErro ?></span>
                    </div>

                    <div class="input-group w50">
                        <label for="dtNasc" class="LabelCadastro">Data de nascimento</label>
                        <input type="date" id="dtNasc" name="dtNasc" value="<?php echo $dtNasc; ?>" required>
                        <span class="obrigatorio">*<?php echo $dtNascErro ?></span>
                    </div>

                    <div class="input-group w50">
                        <label for="genero" class="LabelCadastro">Gênero</label>
                        <span class="obrigatorio">*<?php echo $generoErro ?></span>
                        <select name="genero">
                            <option value="fem" <?php if ($genero == 'fem') echo 'selected'; ?>>Feminino</option>
                            <option value="mas" <?php if ($genero == 'mas') echo 'selected'; ?>>Masculino</option>
                            <option value="other" <?php if ($genero == 'other') echo 'selected'; ?>>Outro</option>
                        </select>
                    </div>

                    <div class="input-group w50">
                        <label for="senha" class="LabelCadastro">Senha</label>
                        <input type="password" id="senha" name="senha" placeholder="Digite sua senha" required>
                        <span class="obrigatorio">*<?php echo $senhaErro ?></span>
                    </div>

                    <div class="input-group w50">
                        <label for="Confirmarsenha" class="LabelCadastro">Confirmar Senha</label>
                        <input type="password" id="Confirmarsenha" name="confSenha" placeholder="Confirme a senha" required>
                        <span class="obrigatorio">*<?php echo $confSenhaErro ?></span>
                    </div>

                    <div class="input-group">
                        <button type="submit">Cadastrar</button>
                    </div>
                    <p class="PLinkInicio">Voltar para o <a href="index.php" class="a-LinkCadastro"> Inicio </a> </p>
                </form>
            </div>
        </div>
        <span><?php echo $msgErro ?></span>
    </section>
    <script src="assets/js/index.js"></script>
</body>

</html>