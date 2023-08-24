<?php
include "./conexao.php";
include "modelo.php";
include "./base/DB.class.php";
$database = new DB();

$dados = $database->get_results("SELECT * FROM usuarios");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Usuários</title>
</head>

<body>

    <div class="content-wrapper px-4 py-2" style="min-height: 849px;">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Usuários</h1>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="col-sm-6">
                    <a type="button" data-toggle="modal" data-target="#staticBackdrop" class="btn btn-outline-dark btn-sm" style="margin: 10px">Novo</a>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Cadastrar Usuário</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <form>
                                    <div class="row">
                                        <div class="col">
                                            <label for="nome">Nome:</label>
                                            <input type="nome" class="form-control" placeholder="Digite...">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="login">Login:</label>
                                            <input type="login" class="form-control" placeholder="Digite...">
                                        </div>
                                        <div class="col">
                                            <label for="password">Senha:</label>
                                            <input type="password" class="form-control" placeholder="Digite...">
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col">
                                            <label for="perfil">Perfil:</label>
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                <option>ADM</option>
                                                <option>Guest</option>
                                                <option>Usuário</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                        <label for="status">Status:</label>
                                            <select class="form-control" id="exampleFormControlSelect1">
                                                <option>Ativo</option>
                                                <option>Inativo</option>
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                <button type="button" class="btn btn-primary">Salvar</button>
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
                            <th scope="col">Login</th>
                            <th scope="col">Perfil</th>
                            <th scope="col">Status</th>
                            <th scope="col">Funções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($dados as $valor) {
                            echo '
                                <tr>
                                    <th scope="row">' . $valor['id'] . '</th>
                                    <td>' . $valor['nome'] . '</td> 
                                    <td>' . $valor['login'] . '</td>
                                    <td>' . $valor['perfil'] . '</td>
                                    <td>' . $valor['status'] . '</td>
                                    <td width=150px>
                                         <a href="#" class="btn btn-success btn-sm">Editar</a>
                                         <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirma" onclick ="pegar_dados(' . $valor['id'] . ', ' . $valor['nome'] . ')">Excluir</a>
                                     </td>
                                </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>

</html>