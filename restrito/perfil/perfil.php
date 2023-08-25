<?php
include "../conexao.php";
include "../modelo.php";
include "../base/DB.class.php";
include "../base/Funcoes.class.php";


$database = new DB();

$dados = $database->get_results("SELECT * FROM perfil");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

    <div class="content-wrapper px-4 py-2" style="min-height: 849px;">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Perfil</h1>
            </div>
        </div>

        <div class="card">
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
                                <form action="./cadastro_perfil.php" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col">
                                            <label for="nome">Nome:</label>
                                            <input type="nome" class="form-control" name="nome" placeholder="Digite...">
                                        </div>
                                        <div class="col">
                                            <label for="perfil">Status:</label>
                                            <select class="form-control" name="status">
                                                <option>Inativos</option>
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
                        <th scope="col">Menu</th>
                        <th scope="col">Status</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($dados as $valor) {
                        echo '
                                <tr>
                                    <th scope="row">' . $valor['id'] . '</th>
                                    <td>' . $valor['nome'] . '</td> 
                                    <td>' . $valor['menu'] . '</td>
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