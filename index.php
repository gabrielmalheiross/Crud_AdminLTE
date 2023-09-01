<?php
include "./base/DB.class.php";
include "./base/Funcoes.class.php";

$database = new DB();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login do Catinho</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/jadminlte/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/jadminlte/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/jadminlte/AdminLTE-3.2.0/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <?php
        if ($_POST) {
            $login = addslashes($_POST['login']);
            $senha = md5(addslashes($_POST['senha']));

            $validaUsuario = $database->get_results("SELECT 
                                                        usuario.id as id 
                                                        ,usuario.nome as nome 
                                                        ,usuario.login as login
                                                        ,usuario.perfil as perfil
                                                        ,perfil.nome as nome_perfil
                                                        ,menu.link as link
                                                        ,permissao.id as id_permissao
                                                        FROM menu
                                                        LEFT JOIN permissao ON menu.id = permissao.id_menu
                                                        LEFT JOIN perfil ON permissao.id_menu = perfil.id
                                                        LEFT JOIN usuario ON perfil.id = usuario.perfil
                                                        WHERE usuario.login = '$login' AND usuario.senha = '$senha'
                                                ");

            // printR($validaUsuario);

            if (count($validaUsuario)) {

                session_start();

                $_SESSION['idUser'] = $validaUsuario[0]['id'];
                $_SESSION['nomeUser'] = $validaUsuario[0]['nome'];
                $_SESSION['loginUser'] = $validaUsuario[0]['login'];
                $_SESSION['idPerfilUser'] = $validaUsuario[0]['perfil'];
                $_SESSION['nomePerfilUser'] = $validaUsuario[0]['nome_perfil'];
                $_SESSION['idPermissao'] = $validaUsuario[0]['id_permissao'];
                $_SESSION['menuLinkUser'] = $validaUsuario[0]['link'];

                // printR($_SESSION['idPermissao']);
               
                echo '
                    <script>
                    window.location.href = "principal.php";
                    </script>';

                // header('location: principal.php');
            } else {
                echo '
                    <script>
                    window.location.href = "index.php?error=2";
                    </script>';
                // header('location: /jadminlte/index.php?error=2');
            }
        } else {
        ?>

            <div class="login-logo">
                <a><b>Sistema CRUD</b></a>
            </div>

            <?php
            if ($_GET['error'] == 2) {
                echo '
                    <div class="alert alert-danger" role="alert">
                        Usuário ou senha invalido.
                    </div>';
            }


            if ($_GET['error'] == 3) {
                echo '
                    <div class="alert alert-warning" role="alert">
                        Usuário sem permissão.
                    </div>';
            }
            ?>

            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Entre com seu login e senha</p>

                    <form action="<?php echo 'index.php'; ?>" method="POST">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Usuário" name="login">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Senha" name="senha">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- .col -->
                            <div class="col">
                                <button type="submit" class="btn btn-primary btn-block" name="entrar">Entrar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <!-- jQuery -->
    <script src="/jadminlte/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/jadminlte/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/jadminlte/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
</body>

</html>