<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Aluno</title>
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
      $dadosAluno = alunos::listarTodosDadosAlunos($idAluno);

      $nomeAluno = null;
      $telefoneAluno = null;
      $enderecoAluno = null;
      $bairroAluno = null;
      $numeroAluno = null;
      $semNumeroAluno = null;
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
          $semNumeroAluno = true;
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
      header("Refresh: 3, url= alunos.php");
      echo "<script> 
        Swal.fire({
          icon: 'warning',
          title: 'Registro n??o encontrado',
          text: 'O registro n??o foi encontrado no Banco de Dados. Redirecionando...',
          timer: 3000
        })
        </script>";
      exit();
    }

  }else{
    header("Location: alunos.php");
    exit();
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
    <p>In??cio -> Lista de Alunos -> Editar Aluno</p>
    <div class="botoes mb-3">
      <a href="./alunos.php"><button type="button" class="btn btn-outline-dark" id="btnVoltarHome"><i class="bi bi-arrow-left-square"></i>&nbsp; Voltar</button></a>
    </div>
    <section class="col-md-12">
      <div class="card border-primary">
        <div class="card-header">
          <h5 class="card-title">Editar Aluno</h5>
          <p class="card-subtitle text-muted">Edite um aluno ao sistema</p>
        </div>
        <div class="card-body">
          <p class="card-text text-muted">
            Preenchimento obrigat??rio (*)<br>
            Preenchimento autom??tico (<i class="bi bi-robot"></i>)
          </p>

          <form action="../controller/alunos.php" method="POST">

            <div class="form-group mb-3">
              <input type="hidden" class="" id="s-i-alunos" name="s-i-alunos" value="<?php echo $idAluno; ?>">
              <label for="nomeAluno" class="form-label preenchimento-obrigatorio">Nome</label>
              <input type="text" class="form-control" id="nomeAluno" name="nomeAluno" placeholder="Nome do aluno" required autofocus <?php echo "value='$nomeAluno'" ?>>
            </div>

            <div class="form-group mb-3">
              <label for="dataNascimento" class="form-label preenchimento-obrigatorio">Data de nascimento</label>
              <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" max="" onclick="" required autofocus <?php echo "value='$dtNascimento'" ?>>
            </div>
            
            <div class="form-group mb-3">
              <label for="celularAluno" class="form-label preenchimento-obrigatorio">Telefone</label>
              <input type="tel" class="form-control" id="celularAluno" name="celularAluno" placeholder="(XX) 97777-8888" required autocomplete="on" pattern="([0-9]{2})\[0-9]{5}-[0-9]{4}" title="Exemplo: (XX) 97777-8888" <?php echo "value='$telefoneAluno'" ?>>
            </div>        

            <div class="form-row mb-3">
             <div class="row g-3">
              <div class="col-auto">
                <label for="cepAluno" class="form-label preenchimento-obrigatorio">CEP</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" id="cepAluno" name="cepAluno" placeholder="00000-000" required autocomplete="off" onkeyup="verificaCEP('cepAluno')" <?php echo "value='$cepAluno'" ?>>
                  <span for="cepAluno" class="input-group-text btn-icon" onclick="verificaCEP('cepAluno')"><i class="bi bi-search"></i></span>
                  <span id="feedback-cepAluno" class=""></span>
                </div>
              </div>

              <div class="col-auto">
                <label for="numeroCasaAluno" class="form-label preenchimento-obrigatorio">N??mero</label>
                <input type="text" class="form-control" id="numeroCasaAluno" name="numeroCasaAluno" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="000" required autocomplete="on" <?php echo "value='$numeroAluno'" ?>>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="endereco-sem-numero" name="endereco-sem-numero" <?php $situacao = $semNumeroAluno == true ? "checked" : ""; echo $situacao; ?>>
                  <label class="form-check-label text-muted" for="endereco-sem-numero">
                    Endere??o sem n??mero
                  </label>
                </div>
              </div>

              <div class="col-auto">
                <label for="complementoCasaAluno" class="form-label">Complemento</label>
                <input type="text" class="form-control" id="complementoCasaAluno" name="complementoCasaAluno" placeholder="Ex: casa" autocomplete="on" <?php echo "value='$complementoAluno'" ?>>
              </div>
             </div>
            </div>
            
            <hr>

            <section class="endereco">
              <p><strong>Endere??o</strong></p>
              <div class="alert alert-primary" role="alert">
                <span class=""><i class="bi bi-info-circle-fill"></i>&nbsp; Voc?? deve pesquisar pelo CEP para que os campos abaixo sejam preenchidos</span>
              </div>
              <div class="form-group mb-3">
                <label for="rua" class="form-label">Rua</label>&nbsp;<i class="bi bi-robot"></i>
                <input type="text" class="form-control" id="rua" name="rua" placeholder="Ex Rua ABC, N.?? 123" readonly <?php echo "value='$enderecoAluno'" ?>>
              </div>
              <div class="form-group mb-3">
                <label for="bairro" class="form-label">Bairro</label>&nbsp;<i class="bi bi-robot"></i>
                <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro do aluno" readonly <?php echo "value='$bairroAluno'" ?>>
              </div>
              <div class="form-group mb-3">
                <label for="cidade" class="form-label">Cidade</label>&nbsp;<i class="bi bi-robot"></i>
                <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade do aluno" readonly <?php echo "value='$cidadeAluno'" ?>>
              </div>
              <div class="form-group mb-3">
                <label for="uf" class="form-label">UF</label>&nbsp;<i class="bi bi-robot"></i>
                <input type="text" class="form-control" id="uf" name="uf" placeholder="UF do aluno" readonly <?php echo "value='$ufAluno'" ?>>
              </div>
              <div class="form-group mb-3">
                <label for="pontoDeReferencia" class="form-label">Ponto de refer??ncia</label>
                <input type="text" class="form-control" id="pontoDeReferencia" name="pontoDeReferencia" placeholder="Ex: Muro rosa" autocomplete="on" <?php echo "value='$referenciaAluno'" ?>>
              </div>
            </section>

            <hr>

            <section>

              <p><strong>Status do aluno</strong></p>

              <div class="form-check">
                <input class="form-check-input" type="radio" value="1" id="alunoAtivo" name="statusAluno" required <?php $situacao = $statusAluno == 1 ? "checked" : ""; echo $situacao; ?>>
                <label class="form-check-label" for="alunoAtivo">
                  Ativo
                </label>
              </div>
  
              <div class="form-check">
                <input class="form-check-input" type="radio" value="0" id="alunoInativo" name="statusAluno" required <?php $situacao = $statusAluno == 0 ? "checked" : ""; echo $situacao; ?>>
                <label class="form-check-label" for="alunoInativo">
                  Inativo
                </label>
              </div>
            </section>

            <hr>

            <div class="botoes">
              <button type="submit" class="btn btn-primary" id="btn-enviar-edicao-aluno" name="btn-enviar-edicao-aluno">Enviar &nbsp;<i class="bi bi-arrow-right-square"></i></button>
              <div class="acoes-secundarias">
                <button type="reset" class="btn btn-outline-secondary" onclick="location.reload()">Limpar &nbsp;<i class="bi bi-trash"></i></button>
                <button class="btn btn-outline-dark" id="imprimir" name="imprimir" onclick="window.print()">Imprimir &nbsp;<i class="bi bi-printer"></i></button>
              </div>
            </div>
          </form>
      </div>
    </section>
  </main>

  <script>
    setInterval(() => {
      let checkboxEnderecoSemNumero = document.querySelector("#endereco-sem-numero");
      let inputNumeroEndereco = document.querySelector("#numeroCasaAluno");
      let btnEnviar = document.querySelector("#btn-enviar-edicao-aluno");
      
      if(checkboxEnderecoSemNumero.checked == true){
        inputNumeroEndereco.removeAttribute('required');
      }else{
        inputNumeroEndereco.setAttribute('required',true);
      }
    },500);
  </script>

</body>
</html>