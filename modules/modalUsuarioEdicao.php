<?php
include "../base/DB.class.php";
include "../base/Funcoes.class.php";

$database = new DB();

$getId = isset($_GET['id']) ? $_GET['id'] : null;
$acao = isset($_GET['acao']) ? $_GET['acao'] : null;

$edicao = $database->get_results("SELECT u.*
                                                        ,p.id as id_perfil
                                                        ,p.nome as nome_perfil
                                                        FROM usuario u 
                                                        LEFT JOIN perfil p on p.id = u.perfil 
                                                        WHERE u.id = '$getId'");
                                                        
$perfils = $database->get_results("SELECT p.* FROM perfil p ");


?>


<form action="grafico.php?acao=save&id=<?php echo $edicao[0]['id']; ?>" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-1">
            <label for="id">ID:</label>
            <input type="text" class="form-control" name="id" readonly value="<?php echo $edicao[0]['id']; ?>">
        </div>
        <div class="col">
            <label for="nome">Nome:</label>
            <input type="text" class="form-control" name="nome" placeholder="Digite..." required value="<?php echo $edicao[0]['nome']; ?>">
        </div>
        <div class="col-3">
            <label for="login">Login:</label>
            <input type="text" class="form-control" name="login" placeholder="Digite..." required value="<?php echo $edicao[0]['login']; ?>">
        </div>
        <div class="col-3">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" name="senha" placeholder="Digite...">
        </div>
    </div>
    <div class="row">
        <div class="col-3">
            <label for="perfil">Perfil:</label>
            <select class="form-control" name="perfil" required>
                <option value="">Selecione</option>
                <?php foreach ($perfils as $perfil) : ?>
                    <option value="<?= $perfil['id'] ?>" <?php if ($edicao[0]['id_perfil'] == $perfil['id']) {
                                                                echo "selected";
                                                            }; ?>> <?= $perfil['nome'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="form-group" style="margin-top: 10px;">
        <a href="./graficos.php" type="button" class="btn btn-danger" data-dismiss="modal">Fechar</a>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>

