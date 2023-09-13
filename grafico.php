<?php
include "./base/DB.class.php";
include "./conexao/validar.php";
include "./base/Funcoes.class.php";

$database = new DB();

// printR($_SESSION);
// exit;
$idUser = $_SESSION['idUser'];
$usuarios = $database->get_results("SELECT u.*
                                            ,p.nome as perfil_nome
                                            ,p.id as perfil_id
                                            FROM usuario u 
                                            LEFT JOIN perfil p on p.id = u.perfil
                                            ");

// session_start();
// validaUsuario();
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="/jadminlte/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/jadminlte/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/jadminlte/AdminLTE-3.2.0/dist/css/adminlte.min.css">
    <title>Tela Inicial</title>
    <link rel="icon" type="image/x-icon" href="c:/Users/gabriel.jesus/Pictures/bug-slash-solid.svg">


</head>

<body>
    <!DOCTYPE html>
    <html lang="pt-BR">

    <body>
        <?php include "./template/template.php"; ?>

        <div class="content-wrapper px-4 py-2" style="min-height: 849px;">
            <h1>Gráfico teste</h1>

            <div class="card-header">
                <div class="col-sm-6">
                    <a type="button" href="./usuarios.php?acao=form" class="btn btn-outline-dark btn-sm" style="margin: 10px">Novo</a>
                </div>
                <div class="card">
                    <div style="margin: 15px">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Perfil</th>
                                    <th scope="col">Login</th>
                                    <th scope="col">Funções</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php


                                foreach ($usuarios as $usuario) {
                                    echo '
                                            <tr>
                                                <th scope="row">' . $usuario['id'] . '</th>
                                                <td>' . $usuario['nome'] . '</td> 
                                                <td>' . $usuario['login'] . '</td>
                                                <td>' . $usuario['perfil_nome'] . '</td>
                                                <td width=150px>
                                                    <button type="button" class="btn btn-success btn-sm" onclick="abrirModal(' . $usuario['id'] . ')">Editar</button>
                                                    <a href="./usuarios.php?acao=delete&id=' . $usuario['id'] . '" class="btn btn-danger btn-sm"">Excluir</a>
                                                </td>
                                            </tr>';
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

    </body>


    <!-- jQuery -->
    <script src="/jadminlte/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/jadminlte/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/jadminlte/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
    <!-- <script src="/jadminlte/AdminLTE-3.2.0/dist/js/demo.js"></script> -->

    <script>
        function abrirModal(id) { //Por aqui passa o id do onclick
            openModal('Editar', 'Editar Usuário', `./modules/modalCadastro.php?id=${id}`); //pega a function do arquivo scriptjs, passa os parametros: nome moda, titulo modal, e localização do modal passando id como parametro
        }
    </script>

    </html>