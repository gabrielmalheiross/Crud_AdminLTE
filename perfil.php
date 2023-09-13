    <?php
    include "./base/DB.class.php";
    include "./base/Funcoes.class.php";
    include "./conexao/validar.php";


    $database = new DB();

    $perfis = $database->get_results("SELECT * FROM perfil");

    $acao = isset($_GET['acao']) ? $_GET['acao'] : null;
    $getId = isset($_GET['id']) ? $_GET['id'] : null;

    $permissaoUsuarioMenuId = 2;

    if (in_array($permissaoUsuarioMenuId, $_SESSION['permissoesMenus'])) {

    ?>

        <!DOCTYPE html>
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

        </head>

        <body>
            <?php include "./template/template.php"; ?>

            <div class="content-wrapper px-4 py-2" style="min-height: 849px;">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Perfil</h1>
                    </div>
                </div>
                <!-- TABELA -->
                <?php
                if ($acao == '') {
                ?>

                    <div class="card-header">
                        <div class="col-sm-6">
                            <a type="button" href="./perfil.php?acao=form" class="btn btn-outline-dark btn-sm" style="margin: 10px">Novo</a>
                        </div>
                        <div class="card">
                            <div style="margin: 15px">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Função</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php


                                        foreach ($perfis as $perfil) {
                                            echo '
                                <tr>
                                    <th scope="row">' . $perfil['id'] . '</th>
                                    <td>' . $perfil['nome'] . '</td> 
                                    <td width=300px>
                                        <a href="./perfil.php?acao=form&id=' . $perfil['id'] . '" class="btn btn-success btn-sm">Editar</a>
                                        <a href="./perfil.php?acao=delete&id=' . $perfil['id'] . '" class="btn btn-danger btn-sm"">Excluir</a>
                                        <a href="./perfil.php?acao=formPermissoes&id=' . $perfil['id'] . '" class="btn btn-warning btn-sm"">Permissões</a>
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
                    if ($getId) {

                        $edicao = $database->get_results("SELECT *
                                                    FROM perfil p
                                                    WHERE p.id = '$getId'");
                        // printR($edicao);
                    } else {
                        $edicao[0]['id'] = null;
                        $edicao[0]['nome'] = null;
                    }

                    // printR($edicao);
                    ?>

                        <div class="card">
                            <div class="form-group" style="margin: 15px">
                                <form action="./perfil.php?acao=save" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-1">
                                            <label for="id">ID:</label>
                                            <input type="text" class="form-control" name="id" readonly value="<?php echo $edicao[0]['id']; ?>">
                                        </div>
                                        <div class="col-3">
                                            <label for="nome">Nome:</label>
                                            <input type="text" class="form-control" name="nome" placeholder="Digite..." required value="<?php echo $edicao[0]['nome']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-top: 10px;">
                                        <a href="./perfil.php" type="button" class="btn btn-danger" data-dismiss="modal">Fechar</a>
                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    <?php

                }

                if ($acao == 'save') {
                    $salvar = [
                        'nome' => $_POST['nome']
                    ];
                    if (isset($_POST['id'])) {
                        #################
                        ##EDIÇÃO/UPDATE##
                        #################
                        $where = ['id' => $_POST['id']];
                        $update = $database->update('perfil', $salvar, $where, 1);
                        $idLast = $_POST['id'];
                        // printR($_POST['id']);
                        if ($update) {
                            mensagem('Perfil atualizado com sucesso', 'success');
                        } else {
                            mensagem('Não foi possível atualizar o perfil', 'danger');
                        }
                    } else {
                        ###################
                        ##CADASTRO/INSERT##
                        ###################
                        $insert = $database->insert('perfil', $salvar);
                        $idLast = $database->lastid();
                        // printR($salvar);
                        if ($insert) {
                            mensagem('Perfil cadastrado com sucesso', 'success');
                        } else {
                            mensagem('Não foi possível cadastrar o perfil', 'danger');
                        }
                    }
                    ?>
                        <a href="./perfil.php" type="button" class="btn btn-danger" data-dismiss="modal">Fechar</a>
                    <?php
                }

                ##############
                ##GET DELETE##
                ##############
                if ($acao == 'delete') {


                    // $getId = $_GET['id'];
                    $getPerfil = $database->get_results("SELECT p.id as id
                                                                ,p.nome as get_nome
                                                                FROM Perfil p 
                                                                WHERE id = $getId
                                                                ");
                    // printR($_GET['id']);
                    ?>


                        <div class="card">
                            <div class="form-group" style="margin: 15px">
                                <form action="./perfil.php?acao=delete&id=<?php echo $_GET['id'] ?>" method="POST">
                                    <div class="modal-body">
                                        <?php echo '<p>Deseja realmente excluir <b id="nome_excluir">' . $getPerfil[0]['get_nome'] . '</b>?</p>';
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="./perfil.php" type="button" class="btn btn-secondary">Cancelar</a>
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

                    ################################
                    ##GET FORMULARIO DE PERMISSÕES##
                    ################################

                    if ($acao == 'formPermissoes') {

                        $nomePerfil = $database->get_results("SELECT 
                                                                    p.id
                                                                    ,p.nome as perfil_nome
                                                                    FROM perfil p
                                                                    WHERE p.id = $getId
                                                                    ");

                        $permissoes = $database->get_results("SELECT perm.id
                                                                    ,perm.id_menu
                                                                    ,m.nome as menu_nome
                                                                    FROM permissao perm
                                                                    left join menu m on m.id = perm.id_menu 
                                                                    WHERE perm.id_perfil = $getId");

                        $menus = $database->get_results("SELECT * FROM menu m WHERE m.id NOT IN (SELECT id_menu FROM permissao WHERE id_perfil = $getId)");
                        ?>
                        <div class="card">
                            <div class="form-group" style="margin: 15px">
                                <h2>Permissões - <?php echo $nomePerfil[0]['perfil_nome']; ?></h2>


                                <div class="col">
                                    <form action="./perfil.php?acao=formPermissoes&id=<?php echo $getId ?>" method="POST">
                                        <select class="form-control form-control-lg" name="menu">
                                            <?php
                                            foreach ($menus as $menu) {
                                                echo '<option value="' . $menu['id'] . '">' . $menu['nome'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <button type="submit" class="btn btn-success btn-sm" style="margin: 10px; margin-bottom: 10px; float: right;">Salvar</button>
                                    </form>
                                </div>

                                <?php
                                #######################
                                ##ADICIONAR PERMISSAO##
                                #######################

                                if ($_POST) {
                                    $salvar = [
                                        'id_perfil' => $_GET['id'],
                                        'id_menu' => $_POST['menu']
                                    ];

                                    $insert = $database->insert('permissao', $salvar);
                                    $idLast = $database->lastid();
                                    // printR($insert);
                                    if ($insert) {
                                        mensagem('Usuário cadastro com sucesso', 'success');

                                        echo "<script> setTimeout(()=>{
                                            location.href = './perfil.php?acao=formPermissoes&id=$getId'
                                        }, 2000) </script>";
                                    } else {
                                        mensagem('Não foi possível cadastrar o usuário', 'danger');
                                    }
                                }
                                ?>


                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="row">ID</th>
                                            <th>ID Menu</th>
                                            <th>Menu Nome</th>
                                            <th>Funções</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($permissoes as $permissao) {
                                            echo '<tr>
                                                    <th scope="row">' . $permissao['id'] . '</th>
                                                    <td>' . $permissao['id_menu'] . '</td>
                                                    <td>' . $permissao['menu_nome'] . '</td>
                                                        <td width=150px> 
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" onclick="pegar_dados(' .  $permissao['id'] . ', \'' . $permissao['menu_nome'] . '\', ' . $getId . ')" > Excluir </button>
                                                        </td>
                                                    </tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <a href="./perfil.php" class="btn btn-primary btn-sm">Voltar</a>
                            </div>
                        </div>

                        <div class="modal fade" id="deleteModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="./perfil.php?acao=deletePermissoes" method="POST">
                                        <div class="modal-body">
                                            <p>Deseja realmente excluir <b id="nome_pessoa"></b>?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                                            <input type="hidden" name="permissao_id" id="permissao_id" value="">
                                            <input type="hidden" name="perfil_id" id="perfil_id" value="">
                                            <input type="submit" class="btn btn-danger" value="Sim">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                <?php
                    }

                    if ($acao == 'deletePermissoes') {
                        if ($_POST) {

                            $perfil_id = $_POST['perfil_id'];
                            $where = array('id' => $_POST['permissao_id']);

                            $delete = $database->delete('permissao', $where, 1);
                            if ($delete) {
                                mensagem('Usuário deletado com sucesso', 'success');

                                echo "<script> setTimeout(()=>{
                                    location.href = './perfil.php?acao=formPermissoes&id=$perfil_id'
                                }, 2000) </script>";
                            } else {
                                mensagem('Não foi possível deletar o usuário', 'danger');
                            }
                        }
                    }
                } else {
                    header("location: /jadminlte/principal.php?msg=sem-autorização");
                }
                ?>

                    </div>
            </div>

            <script>
                function pegar_dados(id, nome, perfil_id) {
                    document.getElementById('nome_pessoa').innerHTML = nome;
                    document.getElementById('permissao_id').value = id;
                    document.getElementById('perfil_id').value = perfil_id;
                }
            </script>

            <!-- jQuery -->
            <script src="/jadminlte/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
            <!-- Bootstrap 4 -->
            <script src="/jadminlte/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
            <!-- AdminLTE App -->
            <script src="/jadminlte/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
            <!-- <script src="/jadminlte/AdminLTE-3.2.0/dist/js/demo.js"></script> -->
        </body>

        </html>