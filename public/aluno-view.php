<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ver Aluno</title>
  <link rel="shortcut icon" href="./imagens/logo.svg" type="image/x-icon">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./javascript/script.js"></script>
</head>
<body>
  
<?php

  require("../lib/parametros-basicos-cabecalho.php");

  if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
    $idAluno = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    include('../class/alunos.php');
    $alunos = new alunos();
    $consultaExistencia = alunos::verificarExistenciaAluno($idAluno);

    if($consultaExistencia){
      // echo $_GET['id'];
      // echo "recebeu";
      $dadosAluno = alunos::listarTodosDadosAlunos($idAluno);

      $nomeAluno = null;
      $telefoneAluno = null;
      $enderecoAluno = null;
      $bairroAluno = null;
      $numeroAluno = null;
      $complementoAluno = null;
      $cidadeAluno = null;
      $cepAluno = null;
      $ufAluno = null;
      $referenciaAluno = null;
      $dtNascimento = null;
      $statusAluno = null;

      foreach($dadosAluno as $key => $value){
        $nomeAluno = htmlentities($value['nome_aluno']);
        $telefoneAluno = htmlentities($value['telefone']);
        $enderecoAluno = htmlentities($value['endereco']);
        $bairroAluno = htmlentities($value['bairro']);
        
        if(htmlentities($value['numero']) == "" || htmlentities($value['numero']) == null){
          $numeroAluno = "S/N";
        }else{
          $numeroAluno = htmlentities($value['numero']);
        }
        
        $complementoAluno = htmlentities($value['complemento']);
        $cidadeAluno = htmlentities($value['cidade']);
        $cepAluno = htmlentities($value['cep']);
        $ufAluno = htmlentities($value['uf']);
        $referenciaAluno = htmlentities($value['referencia']);
        $dtNascimento = htmlentities($value['dt_nascimento']);
        $statusAluno = htmlentities($value['status_aluno']);
      }

    }else{
      // header("Location: alunos.php");
      header("Refresh: 3, url= alunos.php");
      echo "<script> 
        Swal.fire({
          icon: 'warning',
          title: 'Registro não encontrado',
          text: 'O registro não foi encontrado no Banco de Dados. Redirecionando...',
          timer: 3000
        })
        </script>";
    }

  }else{
    header("Location: alunos.php");
  }

?>

  <header>
    <nav class="navbar navbar-expand-lg nav-header">
      <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img src="./imagens/logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
            <strong>Projeto Modelo</strong>
          </a>
        <div class="collapse d-flex" id="navbarTogglerDemo03">
        </div>
      </div>
    </nav>
  </header>

  <main class="container mt-4">
    <p>Início -> Lista de Alunos -> Ver aluno</p>
    <div class="botoes mb-3">
      <a href="./alunos.php"><button type="button" class="btn btn-outline-dark" id="btnVoltarHome"><i class="bi bi-arrow-left-square"></i>&nbsp; Voltar</button></a>
    </div>
    <section class="col-md-12">
      <div class="card border-primary">
        <div class="card-header">
          <h5 class="card-title">Ver Aluno</h5>
          <p class="card-subtitle text-muted">Este é um aluno do sistema</p>
        </div>
        <div class="card-body">
          <form action="#" method="POST">

            <div class="form-group mb-3">
              <label for="nomeAluno" class="form-label ">Nome</label>
              <input type="text" class="form-control" id="nomeAluno" name="nomeAluno" readonly <?php echo "value='$nomeAluno'" ?>>
            </div>

            <div class="form-group mb-3">
              <label for="dataNascimento" class="form-label">Data de nascimento</label>
              <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" max="" onclick="" <?php echo "value='$dtNascimento'" ?> readonly>
            </div>
            
            <div class="form-group mb-3">
              <label for="celularAluno" class="form-label">Telefone</label>
              <input type="tel" class="form-control" id="celularAluno" name="celularAluno" readonly <?php echo "value='$telefoneAluno'" ?>>
            </div>        

            <div class="form-row mb-3">
             <div class="row g-3">
              <div class="col-auto">
                <label for="cepAluno" class="form-label">CEP</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" id="cepAluno" name="cepAluno" readonly <?php echo "value='$cepAluno'" ?>>
                </div>
              </div>

              <div class="col-auto">
                <label for="numeroCasaAluno" class="form-label">Número</label>
                <input type="text" class="form-control" id="numeroCasaAluno" name="numeroCasaAluno" readonly <?php echo "value='$numeroAluno'" ?>>
              </div>

              <div class="col-auto">
                <label for="complementoCasaAluno" class="form-label">Complemento</label>
                <input type="text" class="form-control" id="complementoCasaAluno" name="complementoCasaAluno" readonly <?php echo "value='$complementoAluno'" ?>>
              </div>
             </div>
            </div>
            
            <hr>

            <section class="endereco">
              <p><strong>Endereço</strong></p>
              <div class="form-group mb-3">
                <label for="rua" class="form-label">Rua</label>&nbsp;<i class="bi bi-robot"></i>
                <input type="text" class="form-control" id="rua" name="rua" readonly <?php echo "value='$enderecoAluno'" ?>>
              </div>
              <div class="form-group mb-3">
                <label for="bairro" class="form-label">Bairro</label>&nbsp;<i class="bi bi-robot"></i>
                <input type="text" class="form-control" id="bairro" name="bairro" readonly <?php echo "value='$bairroAluno'" ?>>
              </div>
              <div class="form-group mb-3">
                <label for="cidade" class="form-label">Cidade</label>&nbsp;<i class="bi bi-robot"></i>
                <input type="text" class="form-control" id="cidade" name="cidade" readonly <?php echo "value='$cidadeAluno'" ?>>
              </div>
              <div class="form-group mb-3">
                <label for="uf" class="form-label">UF</label>&nbsp;<i class="bi bi-robot"></i>
                <input type="text" class="form-control" id="uf" name="uf" readonly <?php echo "value='$ufAluno'" ?>>
              </div>
              <div class="form-group mb-3">
                <label for="pontoDeReferencia" class="form-label">Ponto de referência</label>
                <input type="text" class="form-control" id="pontoDeReferencia" name="pontoDeReferencia" readonly <?php echo "value='$referenciaAluno'" ?>>
              </div>
            </section>

            <hr>

            <section>

              <p><strong>Status do aluno</strong></p>

              <div class="form-check">
                <input class="form-check-input" type="radio" value="1" id="alunoAtivo" name="statusAluno" <?php $situacao = $statusAluno == 1 ? "checked" : "disabled"; echo $situacao; ?>>
                <label class="form-check-label" for="alunoAtivo">
                  Ativo
                </label>
              </div>
  
              <div class="form-check">
                <input class="form-check-input" type="radio" value="0" id="alunoInativo" name="statusAluno" <?php $situacao = $statusAluno == 0 ? "checked" : "disabled"; echo $situacao; ?>>
                <label class="form-check-label" for="alunoInativo">
                  Inativo
                </label>
              </div>
            </section>

            <hr>

            <div class="botoes">
            <a href="./alunos.php"><button type="button" class="btn btn-dark" id="btnVoltarHome"><i class="bi bi-arrow-left-square"></i>&nbsp; Voltar</button></a>
              <div class="acoes-secundarias">
                <button class="btn btn-outline-dark" id="imprimir" name="imprimir" onclick="window.print()">Imprimir &nbsp;<i class="bi bi-printer"></i></button>
              </div>
            </div>
          </form>
      </div>
    </section><br><br>
  </main>
</body>
</html>