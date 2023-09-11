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
        <link rel="stylesheet" href="/jadminlte/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
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

                <a type="button" href="menu.php?acao=form" class="btn btn-outline-dark btn-sm" style="margin: 10px">Novo</a>
                <div class="card">
                    <table class="table table-bordered" style="margin: 15px">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Link</th>
                                <th scope="col">Menu-Pai</th>
                                <th scope="col">Ordem</th>
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
                                    <td>' . $menu['ordem'] . '</td> 
                                    <td width=150px>
                                         <a href="menu.php?acao=form&id=' . $menu['id'] . '" class="btn btn-success btn-sm">Editar</a>
                                         <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirma" onclick ="pegar_dados(' . $menu['id'] . ', ' . $menu['nome'] . ')">Excluir</a>
                                     </td>
                                </tr>';
                            }
                        }

                        if ($acao == 'form') {
                            if ($getId) {
                            
                                $edicao = $database->get_results("SELECT m.*
                                                                    FROM menu m 
                                                                    WHERE m.id = '$getId'");
                                // printR($edicao);
                            }else{
                                $edicao[0]['id'] = null;
                                $edicao[0]['nome'] = null;
                                $edicao[0]['link'] = null;
                            }
                            

                            $menus_pai = $database->get_results("SELECT * 
                                                                    FROM menu
                                                                    WHERE menu_pai IS NULL");
                            ?>
                            <div class="card">
                                <div class="form-group" style="margin: 15px">
                                    <form action="./usuarios.php?acao=save" method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-1">
                                                <label for="id">ID:</label>
                                                <input type="text" class="form-control" name="id" readonly <?php echo $edicao[0]['id']; ?>>
                                            </div>
                                            <div class="col">
                                                <label for="nome">Nome:</label>
                                                <input type="text" class="form-control" name="nome" placeholder="Digite..." required <?php echo $edicao[0]['nome']; ?>>
                                            </div>
                                            <div class="col-3">
                                                <label for="link">Link:</label>
                                                <input type="text" class="form-control" name="link" placeholder="Digite..." required <?php echo $edicao[0]['link']; ?>>
                                            </div>
                                            <div class="col-3">
                                                <label for="menu_pai">Menu-pai:</label>
                                                <select class="form-control" name="menu_pai" required>
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    foreach ($perfils as $perfil) {
                                                        echo '<option value="' . $perfil['id'] . '">' . $perfil['nome'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">
                                                <label for="perfil">Perfil:</label>
                                                <select class="form-control" name="perfil" required>
                                                    <option value="">Selecione</option>
                                                    <?php
                                                    foreach ($menus_pai as $menu_pai) {
                                                        echo '<option value="' . $menu_pai['id'] . '">' . $menu_pai['nome'] . '</option>';
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