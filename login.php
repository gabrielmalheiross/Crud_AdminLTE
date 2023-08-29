<?php
    $login = $_POST['login'];
    $senha = md5($_POST['senha']);
    $entrar = $_POST['entrar'];

if (isset($entrar)) {
    include "./restrito/conexao.php";
    $sql = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha'";

    if ($result = mysqli_query($conn, $sql)) {
        $num_registros = mysqli_num_rows($result);
        if ($num_registros == 1) {
            $linha = mysqli_fetch_assoc($result);
            if (($login == $linha['login']) && ($senha == $linha['senha'])) {

                session_start();
                $_SESSION['login'] = $login;
                header("location: restrito");
                // print_r($login);
            } else {
                echo "Login Inválido";
            }
        } else {
            echo "Login ou senha não encontrados ou inválido.";
        }
    } else {
        echo "Nenhum resultado do Banco de Dados.";
    }
}
