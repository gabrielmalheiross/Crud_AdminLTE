<?php
function printR($var)
{
	echo '<pre>';
	print_r($var);
	echo '</pre>';
}

function mensagem($texto, $tipo)
{
	echo
	"<div class='alert alert-$tipo' role='alert'>
                $texto
            </div>";
}


?>

<script>
	function pegar_dados(id, nome) {
            document.getElementById('nome_excluir').innerHTML = nome;
            document.getElementById('id_excluir').value = id;
            document.getElementById('nome_excluir1').value = nome;
        }
</script>