<?php
include "./conexao.php";
include "modelo.php";
include "./base/DB.class.php";

function mostra_data($data) {
    $d = explode('/', $data);
    $escreve = $d[2] ."-". $d[1] ."-". $d[0];
    return $escreve;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Links</title>
    </head>

    <body>
        <div class="content-wrapper px-4 py-2" style="min-height: 849px;">
            data do form:
            <?php
            $formData = '31/08/2023';

            echo implode("-",array_reverse(explode("/",$formData)));
            ?>

            <hr>
            data formatada:
            <?php


            // preciso nesse formato: 'Y-m-d'
            // ex: '2023-08-31'
            $new_date = '2023-08-31';
            echo $new_date;

            ?>
        </div>
    </body>

    </html>
</body>

</html>