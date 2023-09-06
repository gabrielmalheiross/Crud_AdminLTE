<?php
include "./base/DB.class.php";
include "./base/Funcoes.class.php";
include "./conexao/validar.php";

$permissaoUsuarioMenuId = 3;



if (in_array($permissaoUsuarioMenuId, $_SESSION['permissoesMenus'])) {

?>

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


        // session_start();

        $acao = isset($_GET['acao']) ? $_GET['acao'] : null;
        $getID = isset($_GET['id']) ? $_GET['id'] : null;

        $database = new DB();

        $perfils = $database->get_results("SELECT p.* FROM perfil p ");

        $usuarios = $database->get_results("SELECT u.*
                                                ,p.nome as perfil_nome
                                                ,p.id as perfil_id
                                                FROM usuario u 
                                                LEFT JOIN perfil p on p.id = u.perfil
                                                ");

        ?>
    </head>

    <body>
        <?php include "./template/template.php"; ?>

        <div class="content-wrapper px-4 py-2" style="min-height: 849px;">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Usuários</h1>
                </div>
            </div>

            <!-- TABELA -->
            <?php
            if ($acao == '') {

                // printR($_SESSION);
            ?>

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
                                                    <a href="./usuarios.php?acao=form&id=' . $usuario['id'] . '" class="btn btn-success btn-sm">Editar</a>
                                                    <a href="./usuarios.php?acao=delete&id=' . $usuario['id'] . '" class="btn btn-danger btn-sm"">Excluir</a>
                                                </td>
                                            </tr>';
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                <?php
            }

            if ($acao == 'form') {
                $edicao = $database->get_results("SELECT u.*
                                                    ,p.id as id_perfil
                                                    ,p.nome as nome_perfil
                                                    FROM usuario u 
                                                    LEFT JOIN perfil p on p.id = u.perfil 
                                                    WHERE u.id = '$getID'");
                // printR($edicao);
                ?>

                    <div class="card">
                        <div class="form-group" style="margin: 15px">
                            <form action="./usuarios.php?acao=save" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-1">
                                        <label for="id">ID:</label>
                                        <input type="text" class="form-control" name="id" disabled <?php if (isset($_GET['id'])) {
                                                                                                        echo 'value="' . $edicao[0]['id'] . '"';
                                                                                                    } ?>>
                                    </div>
                                    <div class="col">
                                        <label for="nome">Nome:</label>
                                        <input type="text" class="form-control" name="nome" placeholder="Digite..." required <?php if (isset($_GET['id'])) {
                                                                                                                                    echo 'value="' . $edicao[0]['nome'] . '"';
                                                                                                                                } ?>>
                                    </div>
                                    <div class="col-3">
                                        <label for="login">Login:</label>
                                        <input type="text" class="form-control" name="login" placeholder="Digite..." required <?php if (isset($_GET['id'])) {
                                                                                                                                    echo 'value="' . $edicao[0]['login'] . '"';
                                                                                                                                } ?>>
                                    </div>
                                    <div class="col-3">
                                        <label for="senha">Senha:</label>
                                        <input type="password" class="form-control" name="senha" placeholder="Digite..." required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <label for="perfil">Perfil:</label>
                                        <select class="form-control" name="perfil" required>
                                            <option value="">Selecione</option>
                                            <?php
                                            foreach ($perfils as $perfil) {
                                                echo '<option value="' . $perfil['id'] . '">' . $perfil['nome'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" style="margin-top: 10px;">
                                    <a href="./usuarios.php" type="button" class="btn btn-danger" data-dismiss="modal">Fechar</a>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                <?php

            }


            if ($acao == 'delete') {


                $getId = $_GET['id'];
                $getUsuario = $database->get_results("SELECT 
                                                        u.id as id
                                                        ,u.nome as get_nome
                                                        FROM usuario u 
                                                        WHERE id = $getId
                                                    ");
                // printR($_GET['id']);
                ?>

                    <!-- Excluir Usuário -->

                    <div class="card">
                        <div class="form-group" style="margin: 15px">
                            <form action="./usuarios.php?acao=delete&id=<?php echo $_GET['id'] ?>" method="POST">
                                <div class="modal-body">
                                    <?php echo '<p>Deseja realmente excluir <b id="nome_excluir">' . $getUsuario[0]['get_nome'] . '</b>?</p>';
                                    ?>
                                </div>
                                <div class="modal-footer">
                                    <a href="./usuarios.php" type="button" class="btn btn-secondary">Cancelar</a>
                                    <input type="hidden" name="id" value="<?php $_GET['id'] ?>">
                                    <input type="submit" name="deletar" class="btn btn-danger" value="Deletar">
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php
                    ###########
                    ##DELETAR##
                    ###########
                    if ($_POST) {
                        $where = array('id' => $_GET['id']);
                        $delete = $database->delete('usuario', $where, 1);
                        if ($delete) {
                            mensagem('Usuário deletado com sucesso', 'success');
                        } else {
                            mensagem('Não foi possível deletar o usuário', 'danger');
                        }
                    }
                }

                if ($acao == 'save') {
                    $salvar = [
                        'nome' => $_POST['nome'],
                        'login' => $_POST['login'],
                        'senha' => md5($_POST['senha']),
                        'perfil' => $_POST['perfil']
                    ];
                    if (isset($_POST['id'])) {
                        #################
                        ##EDIÇÃO/UPDATE##
                        #################
                        $where = ['id' => $_POST['id']];
                        $update = $database->update('usuario', $salvar, $where, 1);
                        $idLast = $_POST['id'];
                        printR($_POST['id']);
                    } else {
                        ###################
                        ##CADASTRO/INSERT##
                        ###################
                        $insert = $database->insert('usuario', $salvar);
                        $idLast = $database->lastid();
                        printR($salvar);
                        if ($insert) {
                            mensagem('Usuário cadastro com sucesso', 'success');
                        } else {
                            mensagem('Não foi possível cadastrar o usuário', 'danger');
                        }
                    }
                    ?>
                    <a href="./usuarios.php" type="button" class="btn btn-danger" data-dismiss="modal">Fechar</a>
            <?php
                }
            } else {
                header("location: /jadminlte/principal.php?msg=sem-autorização");
            }
            ?>




            <!-- jQuery -->
            <script src="/jadminlte/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap 4 -->
            <script src="/jadminlte/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- AdminLTE App -->
            <script src="/jadminlte/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
            <script src="../../AdminLTE-3.2.0/dist/js/demo.js"></script>


    </body>

    </html>