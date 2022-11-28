<!DOCTYPE html>
<html lang="pt-br">

    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Adicionar Locação</title>
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
    <body onload="alteraData('inicioLocacao');">

<?php

  require("../lib/parametros-basicos-cabecalho.php");
  include('../class/locacoes.php');
  $dadosAlunos = locacoes::listarAlunosTitulosSelecao('alunos');
  $dadosTitulos = locacoes::listarAlunosTitulosSelecao('titulos');

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
              <p>Início -> Lista de Locações -> Nova locação</p>
                <div class="botoes mb-3">
                    <a href="./locacoes.php"><button type="button" class="btn btn-outline-dark" id="btnVoltarHome"><i class="bi bi-arrow-left-square"></i>&nbsp; Voltar</button></a>
                </div>
                <section class="col-md-12">
                  <div class="card border-primary">
                    <div class="card-header">
                      <h5 class="card-title">Adicionar Locação</h5>
                      <p class="card-subtitle text-muted">Registre uma nova locação</p>
                    </div>
                    <div class="card-body">
                      <p class="card-text text-muted">Preenchimento obrigatório (*)</p>
                      
                      <form action="../controller/locacoes.php" method="POST">

                        <div class="form-group mb-3">
                          <label for="alunoLocacao" class="form-label preenchimento-obrigatorio">Aluno</label>
                          <select id="selecaoAluno" class="form-control" name="selecaoAluno" required autofocus>
                            <option value="">Selecione um aluno</option>

                            <?php

                              foreach($dadosAlunos as $key => $value){
                                $idAluno = $value['id_aluno'];
                                $nomeAluno = $value['nome_aluno'];

                                echo "<option value='$idAluno'>$nomeAluno - $idAluno</option>";
                              }

                            ?>

                          </select>
                        </div>

                        <div class="form-group mb-3">
                          <label for="alunoLocacao" class="form-label preenchimento-obrigatorio">Título</label>
                          <select id="selecaoTitulo" class="form-control" name="selecaoTitulo" required autofocus>
                            <option value="">Selecione um título</option>
                            
                            <?php

                              foreach($dadosTitulos as $key => $value){
                                $idTitulo = $value['id_titulo'];
                                $nomeTitulo = $value['nome_titulo'];

                                echo "<option value='$idTitulo'>$nomeTitulo - $idTitulo</option>";
                              }

                            ?>

                          </select>
                        </div>

                        <div class="form-group mb-3">
                          <label for="inicioLocacao" class="form-label preenchimento-obrigatorio">Locado em:</label>
                          <input type="date" class="form-control" id="inicioLocacao" name="inicioLocacao" min="2022-08-29" value="2022-08-29" onclick="alteraData(this.id)" required autofocus>
                        </div>

                        <div class="form-group mb-3">
                          <label for="fimLocacao" class="form-label preenchimento-obrigatorio">Entregar em:</label>
                          <input type="date" class="form-control" id="fimLocacao" name="fimLocacao" onclick="dataMin(this.id)"
                          <?php 
                            $dataAtual = date('Y-m-d');
                            $dataFutura = date('Y-m-d', strtotime('+7 days', strtotime($dataAtual)));
                            echo "value='$dataFutura';"; 
                          ?> 
                          required autofocus>
                        </div>

                        <div class="form-group mb-3" style="display: none;">
                          <p><strong class="preenchimento-obrigatorio">Status da locação</strong></p>

                          <div class="form-check">
                            <input class="form-check-input" type="radio" value="1" id="locacaoAtiva" name="statusLocacao" required checked>
                            <label class="form-check-label" for="locacaoAtiva">
                              Ativo
                            </label>
                          </div>
              
                          <div class="form-check">
                            <input class="form-check-input" type="radio" value="0" id="locacaoInativa" name="statusLocacao" required>
                            <label class="form-check-label" for="locacaoInativa">
                              Inativo
                            </label>
                          </div>
                        </div>

                        <div class="botoes">
                          <button type="submit" class="btn btn-primary" id="btn-enviar-nova-locacao" name="btn-enviar-nova-locacao">Enviar &nbsp;<i class="bi bi-arrow-right-square"></i></button>
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