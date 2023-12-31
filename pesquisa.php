<?php
include "./base/DB.class.php";
include "./conexao/validar.php";
// session_start();

$database = new DB();

$permissaoUsuarioMenuId = 1;

if (in_array($permissaoUsuarioMenuId, $_SESSION['permissoesMenus'])) {

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pesquisa</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <!-- <link rel="stylesheet" href="/jadminlte/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="/jadminlte/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="/jadminlte/AdminLTE-3.2.0/dist/css/adminlte.min.css">


    </head>

    <body>
        <?php include "./template/template.php"; ?>

        <div class="content-wrapper px-4 py-2" style="min-height: 849px;">

        </div>

        <!-- jQuery -->
        <script src="/jadminlte/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="/jadminlte/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="/jadminlte/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
        <!-- <script src="../../AdminLTE-3.2.0/dist/js/demo.js"></script> -->
    <?php
} else {
    header("location: /jadminlte/principal.php?msg=sem-autorização");
}
    ?>
    </body>

    </html>