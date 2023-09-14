<?php
include "../base/DB.class.php";
include "../base/Funcoes.class.php";

$database = new DB();

$getId = isset($_GET['id']) ? $_GET['id'] : null;
$acao = isset($_GET['acao']) ? $_GET['acao'] : null;

$getUsuario = $database->get_results("SELECT 
                                                        u.id as id
                                                        ,u.nome as get_nome
                                                        FROM usuario u 
                                                        WHERE id = $getId
                                                    ");


?>


        <form action="grafico.php?acao=delete&id=<?= $getUsuario[0]['id'] ?>" method="POST">
            <div class="modal-body">
                <?php echo '<p>Deseja realmente excluir <b id="nome_excluir">' . $getUsuario[0]['get_nome'] . '</b>?</p>';
                ?>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</a>
                <input type="hidden" name="id" value="<?php $_GET['id'] ?>">
                <input type="submit" name="deletar" class="btn btn-danger" value="Deletar">
            </div>
        </form>
