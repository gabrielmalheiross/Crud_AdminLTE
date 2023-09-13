<?php
include "./base/DB.class.php";
include "./base/Funcoes.class.php";
include "./conexao/validar.php";




$permissaoUsuarioMenuId = 4;

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

        <?php
        $database = new DB();

        $acao = isset($_GET['acao']) ? $_GET['acao'] : null;
        $getId = isset($_GET['id']) ? $_GET['id'] : null;


        ?>
    </head>

    <body>
        <?php include "./template/template.php"; ?>

        <div class="content-wrapper px-4 py-2" style="min-height: 849px;">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Menus</h1>
                </div>
            </div>

            <?php
            if ($acao == '') {

            ?>
                <div class="card-header">
                    <a type="button" href="menu.php?acao=form" class="btn btn-outline-dark btn-sm" style="margin: 10px">Novo</a>
                    <div class="card">
                        <table class="table table-bordered" style="margin: 15px">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Link</th>
                                    <th scope="col">Menu-Pai</th>
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
                                    <td>' . $menu['link'] . '</td> 
                                    <td>' . $menu['menu_pai'] . '</td> 
                                    <td width=150px>
                                         <a href="menu.php?acao=form&id=' . $menu['id'] . '" class="btn btn-success btn-sm">Editar</a>
                                         <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirma" onclick ="pegar_dados(' . $menu['id'] . ', ' . $menu['nome'] . ')">Excluir</a>
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

                    $edicao = $database->get_results("SELECT m.*
                                                                    FROM menu m 
                                                                    WHERE m.id = '$getId'");
                    // printR($edicao);
                } else {
                    $edicao[0]['id'] = null;
                    $edicao[0]['nome'] = null;
                    $edicao[0]['link'] = null;
                    $edicao[0]['menu_pai'] = null;
                    $edicao[0]['icone'] = null;
                }


                $menus_pai = $database->get_results("SELECT * 
                                                                    FROM menu 
                                                                    WHERE menu_pai IS NULL 
                                                                    ");
            ?>
                <div class="card">
                    <div class="form-group" style="margin: 15px">
                        <form action="./menu.php?acao=save" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-1">
                                    <label for="id">ID:</label>
                                    <input type="text" class="form-control" name="id" readonly value="<?= $edicao[0]['id']; ?>">
                                </div>
                                <div class="col">
                                    <label for="nome">Nome:</label>
                                    <input type="text" class="form-control" name="nome" placeholder="Digite..." required value="<?= $edicao[0]['nome']; ?>">
                                </div>
                                <div class="col-3">
                                    <label for="link">Link:</label>
                                    <input type="text" class="form-control" name="link" placeholder="Digite..." value="<?= $edicao[0]['link']; ?>">
                                </div>
                                <div class="col-3">
                                    <label for="menu_pai">Menu-pai:</label>
                                    <select class="form-control" name="menu_pai">
                                        <option value="">Selecione</option>
                                        <?php foreach ($menus_pai as $menu_pai) : ?>
                                            <option value="<?= $menu_pai['id'] ?>" <?php if ($edicao[0]['menu_pai'] == $menu_pai['id']) {
                                                                                        echo "selected";
                                                                                    }; ?>> <?= $menu_pai['nome'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <label for="icone">Ícone:</label>
                                    <input type="text" class="form-control" name="icone" placeholder="Digite..." value="<?= $edicao[0]['icone']; ?>">
                                </div>
                            </div>

                            <div class="form-group" style="margin-top: 10px;">
                                <a href="./menu.php" type="button" class="btn btn-danger" data-dismiss="modal">Fechar</a>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php
            }

            if ($acao == 'save') {
                $data = [
                    'nome' => $_POST['nome'],
                    'link' => $_POST['link'],
                    'menu_pai' => empty($_POST['menu_pai']) ? null : $_POST['menu_pai'],
                    'icone' => $_POST['icone']
                ];
                if ($_POST['id']) {
                    #################
                    ##EDIÇÃO/UPDATE##
                    #################
                    $where = ['id' => $_POST['id']];

                    $update = $database->update('menu', $data, $where, 1);
                    $idLast = $_POST['id'];
                    // printR($_POST['id']);
                    if ($update) {
                        mensagem('Menu atualizado com sucesso', 'success');
                    } else {
                        mensagem('Não foi possível atualizar o menu', 'danger');
                    }
                } else {
                    ###################
                    ##CADASTRO/INSERT##
                    ###################
                    $insert = $database->insert('menu', $data);

                    // printR($salvar);
                    if ($insert) {
                        mensagem('Menu cadastro com sucesso', 'success');
                    } else {
                        mensagem('Não foi possível cadastrar o menu', 'danger');
                    }
                }
            ?>
                <a class="btn btn-primary btn-sm" href="menu.php">Voltar</a>
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
        <!-- <script src="/jadminlte/AdminLTE-3.2.0/dist/js/demo.js"></script> -->
    </body>

    </html>