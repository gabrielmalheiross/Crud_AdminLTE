<?php
include('../base/classes/DB.class.php');
include('../base/classes/Funcoes.class.php');


$dbModal = new DB();

 echo "<form action='modals/cadastro.mdl.php?acao=cadastrar' method='post'>
    <div class='mb-3'>
        <label for='nome' class='form-label'>Nome</label>
        <input type='text' class='form-control' name='nome'>
    </div>
    <div class='mb-3'>
        <label for='email' class='form-label'>Email</label>
        <input type='email' class='form-control' name='email'>
    </div>
    <div class='mb-3'>
        <label for='senha' class='form-label'>Senha</label>
        <input type='text' class='form-control' name='senha'>
    </div>
    <div class='mb-3'>
        <label for='perfil' class='form-label'>Perfil</label>
        <select class='form-control' aria-label='Large select example' name='perfil'>
           <option value='1'>Admin</option>
           <option value='2'>Comum</option>
        </select>
    </div>
    <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fechar</button>
        <button type='submit' class='btn btn-primary'>Salvar</button>
    </div>
</form>"
?>