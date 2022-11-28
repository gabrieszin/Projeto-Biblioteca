<!DOCTYPE html>
<html lang="pt-br">

    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Ver Locação</title>
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
    $idLocacao = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    include('../class/locacoes.php');
    $locacao = new locacoes();
    $consultaExistencia = locacoes::verificarExistenciaLocacao($idLocacao);

    if($consultaExistencia){

      $dadosLocacao = locacoes::listarTodosDadosLocacoes($idLocacao);
      $nomeAluno = null;
      $tipoTitulo = null;
      $dtLocacao = null;
      $dtRetorno = null;
      $statusLocacao = null;

      foreach($dadosLocacao as $key => $value){
        $nomeAluno = htmlentities($value['nome_aluno']);
        $tipoTitulo = htmlentities($value['nome_titulo']);
        $dtLocacao = htmlentities($value['dt_locacao']);
        $dtRetorno = htmlentities($value['dt_retorno']);
        $statusLocacao = htmlentities($value['status_locacao']);
      }

    }else{
      header("Refresh: 3, url= locacoes.php");
      echo "
      <script> 
        Swal.fire({
          icon: 'warning',
          title: 'Registro não encontrado',
          text: 'O registro não foi encontrado no Banco de Dados. Redirecionando...',
          timer: 3000
        })
      </script>";
      exit();
    }

  }else{
    header("Location: titulos.php");
  }

?>

            <header>
                <nav class="navbar navbar-expand-lg nav-header">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">
                            <img src="./imagens/logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
                            <strong>Locação</strong>
                        </a>
                          <div class="collapse d-flex" id="navbarTogglerDemo03">
                          </div>
                        </div>
                      </nav>
            </header>

            <main class="container mt-4">
              <p>Início -> Lista de Locações -> Ver locação</p>
                <div class="botoes mb-3">
                    <a href="./locacoes.php"><button type="button" class="btn btn-outline-dark" id="btnVoltarHome"><i class="bi bi-arrow-left-square"></i>&nbsp; Voltar</button></a>
                </div>
                <section class="col-md-12">
                  <div class="card border-primary">
                    <div class="card-header">
                      <h5 class="card-title">Ver Locação</h5>
                      <p class="card-subtitle text-muted">Esta é uma nova locação do sistema</p>
                    </div>
                    <div class="card-body">
                      
                      <form action="#" method="POST">

                        <div class="form-group mb-3">
                          <label for="alunoLocacao" class="form-label">Aluno</label>
                          <input id="selecaoAluno" class="form-control" name="selecaoAluno" readonly
                          <?php echo "value='$nomeAluno'"; ?>>
                        </div>

                        <div class="form-group mb-3">
                          <label for="alunoLocacao" class="form-label">Título</label>
                          <input id="selecaoTitulo" class="form-control" name="selecaoTitulo" readonly
                          <?php echo "value='$tipoTitulo'"; ?>>
                        </div>

                        <div class="form-group mb-3">
                          <label for="inicioLocacao" class="form-label">Locado em:</label>
                          <input type="date" class="form-control" id="inicioLocacao" name="inicioLocacao" readonly
                          <?php 
                            $dtLocacao = implode('-', array_reverse(explode('/', $dtLocacao)));
                            echo "value='$dtLocacao'";
                          ?>>
                        </div>

                        <div class="form-group mb-3">
                          <label for="fimLocacao" class="form-label">Entregar em:</label>
                          <input type="date" class="form-control" id="fimLocacao" name="fimLocacao" readonly
                          <?php 
                            $dtRetorno = implode('-', array_reverse(explode('/', $dtRetorno)));
                            echo "value='$dtRetorno'";
                          ?>>
                        </div>

                        <div class="form-group mb-3">
                          <p><strong class="">Status da locação</strong></p>

                          <div class="form-check">
                            <input class="form-check-input" type="radio" value="1" id="locacaoAtiva" name="statusLocacao" 
                            <?php $situacao = $statusLocacao == 1 ? "checked" : "disabled"; echo $situacao; ?>>
                            <label class="form-check-label" for="locacaoAtiva">
                              Não devolvido
                            </label>
                          </div>

                          <div class="form-check">
                            <input class="form-check-input" type="radio" value="0" id="locacaoInativa" name="statusLocacao"
                            <?php $situacao = $statusLocacao == 0 ? "checked" : "disabled"; echo $situacao; ?>>
                            <label class="form-check-label" for="locacaoInativa">
                              Devolvido
                            </label>
                          </div>
                        </div>

                        <div class="botoes">
                          <a href="./locacoes.php"><button type="button" class="btn btn-dark" id="btnVoltarHome"><i class="bi bi-arrow-left-square"></i>&nbsp; Voltar</button></a>                          
                        <div class="acoes-secundarias">
                            <button class="btn btn-outline-dark" id="imprimir" name="imprimir" onclick="window.print()">Imprimir &nbsp;<i class="bi bi-printer"></i></button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </section>
            </main>
        </body>
    </html>