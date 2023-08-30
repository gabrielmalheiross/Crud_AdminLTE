<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Usuários</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/jadminlte/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/jadminlte/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/jadminlte/AdminLTE-3.2.0/dist/css/adminlte.min.css">

    <?php
    include "../conexao.php";

    include "../base/DB.class.php";
    include "../base/Funcoes.class.php";
    include "../../validar.php";

    $database = new DB();

    $perfils = $database->get_results("SELECT p.* FROM perfil p ");

    $usuarios = $database->get_results("SELECT a.*
                                        ,p.nome as perfil_nome
                                        ,p.id as perfil_id
                                        FROM usuario a 
                                        LEFT JOIN perfil p on p.id = a.perfil
                                        ");
                                    
    ?>
</head>

<body>
    <?php include "../template.php"; ?>

    <div class="content-wrapper px-4 py-2" style="min-height: 849px;">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Usuários</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="col-sm-6">
                    <a type="button" data-toggle="modal" data-target="#modal_cadastro" class="btn btn-outline-dark btn-sm" style="margin: 10px">Novo</a>
                </div>
                <!-- Modal Cadastro -->
                <div class="modal fade" id="modal_cadastro" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Cadastrar Usuário</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form action="./cadastro_usuarios.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col">
                                            <label for="nome">Nome:</label>
                                            <input type="nome" class="form-control" name="nome" placeholder="Digite...">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="login">Login:</label>
                                            <input type="login" class="form-control" name="login" placeholder="Digite...">
                                        </div>
                                        <div class="col">
                                            <label for="senha">Senha:</label>
                                            <input type="password" class="form-control" name="senha" placeholder="Digite...">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="perfil">Perfil:</label>
                                            <select class="form-control" name="perfil">
                                                <?php
                                                foreach ($perfils as $perfil) {
                                                    echo '<option value="' . $perfil['id'] . '">' . $perfil['nome'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="status">Status:</label>
                                            <select class="form-control" name="status">
                                                <option>Ativo</option>
                                                <option>Inativo</option>
                                            </select>
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
                </div>



                <div class="card-tools">
                    <span class="badge badge-primary"></span>
                </div>
            </div>

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
                                         <a href="#" class="btn btn-success btn-sm">Editar</a>
                                         <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_excluir" onclick ="pegar_dados(' . $usuario['id'] . ', ' . $usuario['nome'] . ')">Excluir</a>
                                     </td>
                                </tr>';
                        }

                        ?>

                        <div class="modal fade" id="modal_excluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmação de exclusão</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="excluir_usuarios.php" method="POST">
                                        <div class="modal-body">
                                            <?php echo '<p>Deseja realmente excluir <b id="nome_excluir">' . $usuarios['id'] . '</b></p>';
                                            ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                            <input type="hidden" name="id" id="id_usuario" value="">
                                            <input type="hidden" name="nome" id="nome_excluir1" value="">
                                            <input type="submit" class="btn btn-danger" value="Sim">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>



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
    <!-- <script src="../../AdminLTE-3.2.0/dist/js/demo.js"></script> -->
</body>

</html>