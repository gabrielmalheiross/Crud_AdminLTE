    <?php
    include "./base/DB.class.php";
    include "./conexao/validar.php";
    include "./base/Funcoes.class.php";

    $database = new DB();

    // session_start();
    // validaUsuario();
    ?>
    
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/jadminlte/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/jadminlte/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/jadminlte/AdminLTE-3.2.0/dist/css/adminlte.min.css">
    <title>Tela Inicial</title>

</head>

<body>
    <!DOCTYPE html>
    <html lang="pt-BR">

    <body>
        <?php include "./template/template.php"; ?>

        <div class="content-wrapper px-4 py-2" style="min-height: 849px;">
            <?php
                echo '<h1>Tela Principal</h1>';
            ?>
        </div>
    </body>


    <!-- jQuery -->
    <script src="/jadminlte/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/jadminlte/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/jadminlte/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
    <!-- <script src="/jadminlte/AdminLTE-3.2.0/dist/js/demo.js"></script> -->

    </html>
</body>

</html>