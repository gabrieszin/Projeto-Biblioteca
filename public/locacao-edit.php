<!DOCTYPE html>
<html lang="pt-br">

    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Editar Locação</title>
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
    $idLocacao = intval($idLocacao);
    include('../class/locacoes.php');
    $locacao = new locacoes();
    $consultaExistencia = locacoes::verificarExistenciaLocacao($idLocacao);
    $dadosAlunos = locacoes::listarAlunosTitulosSelecao('alunos');
    $dadosTitulos = locacoes::listarAlunosTitulosSelecao('titulos');

    if($consultaExistencia){
  
      $dadosLocacao = locacoes::listarTodosDadosLocacoes($idLocacao);
      $nomeAluno = null;
      $tipoTitulo = null;
      $dtLocacao = null;
      $dtRetorno = null;
      $statusLocacao = null;
  
      foreach($dadosLocacao as $key => $value){
        $codAluno = htmlentities($value['cod_aluno']);
        $nomeAluno = htmlentities($value['nome_aluno']);
        $codTitulo = htmlentities($value['cod_titulo']);
        $tipoTitulo = htmlentities($value['nome_titulo']);
        $dtLocacao = htmlentities($value['dt_locacao']);
        $dtRetorno = htmlentities($value['dt_retorno']);
        $statusLocacao = htmlentities($value['locacao']);
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
    header("Location: locacoes.php");
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
              <p>Início -> Lista de Locações -> Editar locação</p>
                <div class="botoes mb-3">
                    <a href="./locacoes.php"><button type="button" class="btn btn-outline-dark" id="btnVoltarHome"><i class="bi bi-arrow-left-square"></i>&nbsp; Voltar</button></a>
                </div>
                <section class="col-md-12">
                  <div class="card border-primary">
                    <div class="card-header">
                      <h5 class="card-title">Editar Locação</h5>
                      <p class="card-subtitle text-muted">Edite uma nova locação</p>
                    </div>
                    <div class="card-body">
                      <p class="card-text text-muted">Preenchimento obrigatório (*)</p>
                      
                      <form action="../controller/locacoes.php" method="POST">

                        <div class="form-group mb-3">
                          <input type="hidden" class="" id="s-i-locacoes" name="s-i-locacoes" value="<?php echo $idLocacao; ?>">
                          <label for="alunoLocacao" class="form-label preenchimento-obrigatorio">Aluno</label>
                          <select id="selecaoAluno" class="form-control" name="selecaoAluno" required autofocus>
                            <option value="">Selecione um aluno</option>

                            <?php

                              foreach($dadosAlunos as $key => $value){
                                $idAluno = htmlentities($value['id_aluno']);
                                $nomeAluno = htmlentities($value['nome_aluno']);

                                if($codAluno == $idAluno){
                                  echo "<option value='$idAluno' selected>$nomeAluno - $idAluno</option>";
                                }else{
                                  echo "<option value='$idAluno'>$nomeAluno - $idAluno</option>";
                                }
                              }
                              
                            ?>

                          </select>
                        </div>

                        <div class="form-group mb-3">
                          <label for="alunoLocacao" class="form-label preenchimento-obrigatorio">Título</label>
                          <select id="selecaoTitulo" class="form-control" name="selecaoTitulo" required autofocus>
                            <option value="">Selecione um título</option>

                            <?php

                              if(isset($codTitulo) && !empty($codTitulo)){
                                $codTitulo = intval($codTitulo);
                                echo "<option value='$codTitulo' selected>$tipoTitulo</option>";
                              }

                              foreach($dadosTitulos as $key => $value){
                                $idTitulo = htmlentities($value['id_titulo']);
                                $nomeTitulo = htmlentities($value['nome_titulo']);

                                if($codTitulo == $idTitulo){
                                  echo "<option value='$idTitulo' selected>$nomeTitulo - $idTitulo</option>";
                                }else{
                                  echo "<option value='$idTitulo'>$nomeTitulo - $idTitulo</option>";
                                }
                              }

                            ?>

                          </select>
                        </div>

                        <div class="form-group mb-3">
                          <label for="inicioLocacao" class="form-label preenchimento-obrigatorio">Locado em:</label>
                          <input type="date" class="form-control" id="inicioLocacao" name="inicioLocacao" onclick="alteraData(this.id)" required autofocus
                          <?php 
                            $dtLocacao = implode('-', array_reverse(explode('/', $dtLocacao)));
                            echo "value='$dtLocacao'";
                          ?>>
                        </div>

                        <div class="form-group mb-3">
                          <label for="fimLocacao" class="form-label preenchimento-obrigatorio">Entregar em:</label>
                          <input type="date" class="form-control" id="fimLocacao" name="fimLocacao" required autofocus
                          <?php 
                            $dtRetorno = implode('-', array_reverse(explode('/', $dtRetorno)));
                            echo "value='$dtRetorno'";
                          ?>>
                        </div>

                        <div class="form-group mb-3">
                          <p><strong class="preenchimento-obrigatorio">Status da locação</strong></p>

                          <div class="form-check">
                            <input class="form-check-input" type="radio" value="1" id="locacaoAtiva" name="statusLocacao" required
                            <?php $situacao = $statusLocacao == 1 ? "checked" : ""; echo $situacao; ?>>
                            <label class="form-check-label" for="locacaoAtiva">
                              Não devolvido
                            </label>
                          </div>
              
                          <div class="form-check">
                            <input class="form-check-input" type="radio" value="0" id="locacaoInativa" name="statusLocacao" required
                            <?php $situacao = $statusLocacao == 0 ? "checked" : ""; echo $situacao; ?>>
                            <label class="form-check-label" for="locacaoInativa">
                              Devolvido
                            </label>
                          </div>
                        </div>

                        <div class="botoes">
                          <button type="submit" class="btn btn-primary" id="btn-enviar-edicao-locacao" name="btn-enviar-edicao-locacao">Enviar &nbsp;<i class="bi bi-arrow-right-square"></i></button>
                          <div class="acoes-secundarias">
                            <button type="reset" class="btn btn-outline-secondary" onclick="location.reload()">Limpar &nbsp;<i class="bi bi-trash"></i></button>
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