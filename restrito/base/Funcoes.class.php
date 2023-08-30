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
		document.getElementById('nome_pessoa').innerHTML = nome;
		document.getElementById('id_pessoa').value = id;
	}
</script>