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
	"<div class='alert alert-$tipo' style='width: 300px;' role='alert'>
                $texto 
            </div>";
}


function validaUsuario(){
	if(!$_SESSION['idUser']){
		echo '
		<script>
		window.location.href = "sair.php?error=3";
		</script>';
	}
}

?>
