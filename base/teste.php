<?php
include './base/DB.class.php';
$database = new DB();
?>
<!doctype html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Teste</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="container-fluid py-5">
          <?php
          $dados = $database->get_results( "SELECT * FROM pessoas where nome <> '' " );
          
          print_r($dados);
          ?>


        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nome</th>
              <th scope="col">Endereço</th>
              <th scope="col">Telefone</th>
              <th scope="col">Email</th>
            </tr>
          </thead>
          <tbody>
            
            <?php
            foreach($dados as $valor){
              echo '
              <tr>
                <th scope="row">'.$valor['id'].'</th>
                <td>'.$valor['nome'].'</td>
                <td>'.$valor['endereco'].'</td>
                <td>'.$valor['telefone'].'</td>
                <td>'.$valor['email'].'</td>
              </tr>';
            }
            ?>

          </tbody>
        </table>

          

        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nome</th>
              <th scope="col">Endereço</th>
              <th scope="col">Telefone</th>
              <th scope="col">Data</th>
              <th scope="col">Data Atual</th>
            </tr>
          </thead>
          <tbody>
            <?php
            for ($i=0; $i < count($dados); $i++) { 

              if($i == 1){
                //$dados[$i]['nome'] = 'Anatan';
              }
              
              echo '
              <tr>
                <th scope="row">'.$dados[$i]['id'].'</th>
                <td>'.$dados[$i]['nome'].'</td>
                <td>'.$dados[$i]['endereco'].'</td>
                <td>'.$dados[$i]['telefone'].'</td>
                <td>'.date('d/m/Y', strtotime($dados[$i]['data_nascimento'])).'</td>
                <td>'.date('d/m/Y H:i:s').'</td>
              </tr>';
            }
            ?>
            
          </tbody>
        </table>

        </div>
      </div>
    </div>
  </div>

  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>