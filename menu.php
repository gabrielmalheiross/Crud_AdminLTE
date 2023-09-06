<?php
include "./base/DB.class.php";
include "./base/Funcoes.class.php";
include "./conexao/validar.php";


$database = new DB();

$permissaoUsuarioMenuId = 4;

if (in_array($_SESSION['permissoesMenus'] , [ $permissaoUsuarioMenuId ])) {

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

</head>

<body>
    <?php include "./template/template.php"; ?>

    <div class="content-wrapper px-4 py-2" style="min-height: 849px;">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Menus</h1>
            </div>
        </div>

        <div class="card-header">
            <div class="col-sm-6">
                <a type="button" data-toggle="modal" data-target="#staticBackdrop" class="btn btn-outline-dark btn-sm" style="margin: 10px">Novo</a>
            </div>
            <!-- Modal Cadastro -->
            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Cadastrar Perfil</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form action="./modules/perfil/cadastro_perfil.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col">
                                        <label for="nome">Nome:</label>
                                        <input type="nome" class="form-control" name="nome" placeholder="Digite...">
                                    </div>
                                    <div class="col">
                                        <label for="perfil">Status:</label>
                                        <select class="form-control" name="status">
                                            <option>Inativo</option>
                                            <option>Ativo</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                        </form>
                    </div>

                </div>
            </div>



            <div class="card-tools">
                <span class="badge badge-primary"></span>
            </div>
        </div>
        <div class="card">

            <div style="margin: 15px">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Funções</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $menus = $database->get_results("SELECT *
                                                                FROM menu");

                        // printR($menus);
                        foreach ($menus as $menu) {
                            echo '
                                <tr>
                                    <th scope="row">' . $menu['id'] . '</th>
                                    <td>' . $menu['nome'] . '</td> 
                                    <td width=150px>
                                         <a href="#" class="btn btn-success btn-sm">Editar</a>
                                         <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirma" onclick ="pegar_dados(' . $menu['id'] . ', ' . $menu['nome'] . ')">Excluir</a>
                                     </td>
                                </tr>';
                        }

                    } else {
                        header("location: /jadminlte/principal.php?msg=sem-autorização");
                    }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="/jadminlte/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/jadminlte/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/jadminlte/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
    <!-- <script src="/jadminlte/AdminLTE-3.2.0/dist/js/demo.js"></script> -->
</body>

</html>