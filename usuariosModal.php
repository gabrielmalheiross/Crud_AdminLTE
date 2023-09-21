<?php
include "./base/DB.class.php";
include "./conexao/validar.php";
include "./base/Funcoes.class.php";

$database = new DB();
$acao = isset($_GET['acao']) ? $_GET['acao'] : null;

// printR($_SESSION);
// exit;
$idUser = $_SESSION['idUser'];


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
            <h1>Tela de Usuários por Modal</h1>
            <div class="card-header">
                <div class="col-sm-6">
                    <button type="button" class="btn btn-outline-dark btn-sm" style="margin: 10px" onclick="modalCadastro()">Novo</button>
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
                                    <th scope="col">Status</th>
                                    <th scope="col">Funções</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $usuarios = $database->get_results("SELECT u.*
                                                                            ,p.nome as perfil_nome
                                                                            ,p.id as perfil_id
                                                                            ,s.nome as status_usuario
                                                                            FROM usuario u 
                                                                            LEFT JOIN perfil p on p.id = u.perfil
                                                                            LEFT JOIN status s on s.id = u.status
                                                                            ");

                                foreach ($usuarios as $usuario) :
                                ?>
                                    <tr>
                                        <th scope="row"><?= $usuario['id'] ?></th>
                                        <td><?= $usuario['nome'] ?></td>
                                        <td><?= $usuario['login'] ?></td>
                                        <td><?= $usuario['perfil_nome'] ?></td>
                                        <td><?= $usuario['status_usuario'] ?></td>
                                        <td width=150px>
                                            <button type="button" class="btn btn-success btn-sm" onclick="modalEdicao(<?php echo $usuario['id']; ?>)">Editar</button>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="modalExcluir(<?php echo $usuario['id']; ?>)">Excluir</button>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
            if ($acao == 'save') {
                $senha = $_POST['senha'];
                $salvar = [
                    'nome' => $_POST['nome'],
                    'login' => $_POST['login'],
                    'perfil' => $_POST['perfil'],
                    'status' => $_POST['status']
                ];
                if (isset($senha) && !empty($senha)) {
                    $salvar['senha'] = md5($senha);
                }

                if ($_POST['id']) {
                    #################
                    ##EDIÇÃO/UPDATE##
                    #################
                    $where = ['id' => $_POST['id']];
                    $update = $database->update('usuario', $salvar, $where, 1);
                    $idLast = $_POST['id'];
                    // printR($_POST['id']);
                    if ($update) {
                        mensagem('Usuário atualizado com sucesso', 'success');
                        echo "<script> setTimeout(()=>{
                            location.href = 'usuariosModal.php'
                        }, 2000) </script>";
                    } else {
                        mensagem('Não foi possível atualizar o usuário', 'danger');
                    }
                } else {
                    ###################
                    ##CADASTRO/INSERT##
                    ###################
                    $insert = $database->insert('usuario', $salvar);
                    $idLast = $database->lastid();
                    // printR($salvar);
                    if ($insert) {
                        mensagem('Usuário cadastro com sucesso', 'success');
                        echo "<script> setTimeout(()=>{
                                    location.href = 'usuariosModal.php'
                                }, 2000) </script>";
                    } else {
                        mensagem('Não foi possível cadastrar o usuário', 'danger');
                    }
                }
            }

            if ($acao == 'delete') {
                if ($_POST) {
                    $where = array('id' => $_GET['id']);
                    $delete = $database->delete('usuario', $where, 1);
                    if ($delete) {
                        mensagem('Usuário deletado com sucesso', 'success');
                        echo "<script> setTimeout(()=>{
                            location.href = 'usuariosModal.php'
                        }, 2000) </script>";
                    } else {
                        mensagem('Não foi possível deletar o usuário', 'danger');
                        echo "<script> setTimeout(()=>{
                            location.href = 'usuariosModal.php'
                        }, 2000) </script>";
                    }
                }
            }
            ?>

        </div>
    </body>

    <?php include './template/scripts.php' ?>

    <script>
        function modalEdicao(id) { //Por aqui passa o id do onclick
            openModal('Editar', 'Editar Usuário', `./modules/modalUsuarioEdicao.php?id=${id}`); //pega a function do arquivo scriptjs, passa os parametros: nome moda, titulo modal, e localização do modal passando id como parametro
        }

        function modalExcluir(id) { //Por aqui passa o id do onclick
            openModal('Excluir', 'Excluir Usuário', `./modules/modalUsuarioExcluir.php?id=${id}`); //pega a function do arquivo scriptjs, passa os parametros: nome moda, titulo modal, e localização do modal passando id como parametro
        }

        function modalCadastro() {
            openModal('Cadastro', 'Cadastrar Usuário', `./modules/modalUsuarioCadastro.php`); //pega a function do arquivo scriptjs, passa os parametros: nome moda, titulo modal, e localização do modal passando id como parametro
        }
    </script>

    </html>