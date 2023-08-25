<?php
include "../conexao.php";
include "../modelo.php";
include "../base/Funcoes.class.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <div class="content-wrapper px-4 py-2" style="min-height: 849px;">
        <?php


        $nome = $_POST['nome'];
        $status = $_POST['status'];

        $sql = "INSERT INTO `perfil`(`nome`, `status`) VALUES ('$nome', '$status')";

        if (mysqli_query($conn, $sql)) {
            mensagem("$nome cadastrado com sucesso!", 'success');
        } else {
            mensagem("$nome NÃO cadastrado!", 'danger');
        }
        ?>

        <a href="perfil.php" class="btn btn-primary">Voltar</a>

    </div>
</body>

</html>