<?php
//     $login = $_POST['login'];
//     $senha = md5($_POST['senha']);
//     $entrar = $_POST['entrar'];
    

// if (isset($entrar)) {
//     include "../../conexao/conexao_antiga.php";
//     $sql = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha'";

//     if ($result = mysqli_query($conn, $sql)) {
//         $num_registros = mysqli_num_rows($result);
//         if ($num_registros == 1) {
//             $linha = mysqli_fetch_assoc($result);
//             if (($login == $linha['login']) && ($senha == $linha['senha'])) {

//                 session_start();
//                 $_SESSION['login'] = $login;
//                 header("location: /jadminlte/principal.php");
//                 // print_r($login);
//             } else {
//                 header("location: /jadminlte/index.php?login-invalido");
//                 echo '<script> alert("Sem autorização") </script>';
//             }
//         } else {
//             header("location: /jadminlte/index.php?login-invalido");
//             echo '<script> alert("Sem autorização") </script>';        }
//     } else {
//         header("location: /jadminlte/index.php?login-invalido");
//         echo '<script> alert("Sem autorização") </script>';    
//     }
// }
