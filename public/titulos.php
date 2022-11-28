<!DOCTYPE html>
<html lang="pt-BR">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Lista de Livros</title>
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
  include_once("../class/titulos.php");
  $tabelaTitulos = new titulos();
  $dadosTitulo = titulos::listarTitulos();
  
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
        <p>Inicio -> Lista de Títulos</p>
        <div class="botoes mb-3">  
            <a href="./sistema.php"><button type="button" class="btn btn-outline-dark" id="btnVoltarHome"><i class="bi bi-arrow-left-square"></i>&nbsp; Voltar</button></a> 
        </div>
        <section class="col-md-12">
        <div class="card border-secondary">
            <div class="card-header card-display-group">
                <div class="principal-header">
                    <h5 class="card-title"> Lista de Títulos </h5>
                    <p class="card-subtitle"> Estes são os títulos registrados no seu sistema </p>
                </div>
                     <div class="acoes-secundarias-header">
                    <a href="./adicionarTitulo.php"><button type="submit" name="" value="" class="btn btn-primary btn-sm float-end" data-toggle="tooltip" data-placement="top" title="Adicionar turma"><i class="bi bi-plus-square"></i>&nbsp; Novo Título</button></a>
                    </div>
            </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                      <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th>Locado?</th>
                                <th>Status</th>
                                <th colspan="2"></th>
                            </tr>
                      </thead>
                      <tbody>

                        <?php

                          foreach($dadosTitulo as $key => $value){
                            $idTitulo = htmlentities($value['id_titulo']);

                            echo "<tr>";
                            echo "<td>" . $idTitulo . "</td>";
                            echo "<td>" . htmlentities($value['nome_titulo']) . "</td>";
                            echo "<td>" . htmlentities($value['tipo']) . "</td>";
                            
                            $statusLocado = htmlentities($value['locacao']);

                            if($statusLocado == 0){
                              $statusLocado = "Não";
                            }else{
                              $statusLocado = "Locado";
                            }

                            echo "<td>" . $statusLocado . "</td>";

                            $statusTitulo = htmlentities($value['status_titulo']);

                            if($statusTitulo == 0){
                              $statusTitulo = "Inativo";
                            }else{
                              $statusTitulo = "Ativo";
                            }

                            echo "<td>" . $statusTitulo . "</td>";

                            echo "
                            <td>
                              <a href='titulo-view.php?id=$idTitulo' class='btn btn-secondary btn-sm' data-toggle='tooltip' data-placement='top' title='Ver em detalhes' tabindex='0'><i class='bi bi-view-list'></i>&nbsp; Ver</a>&nbsp;
                              <a href='titulo-edit.php?id=$idTitulo' class='btn btn-primary btn-sm' data-toggle='tooltip' data-placement='top' title='Editar registro' tabindex='0'><i class='bi bi-pencil-square'></i>&nbsp; Editar</a>&nbsp;
                              <button type='submit' name='' value='$idTitulo' class='btn btn-danger btn-sm' onclick='confirmaExclusao($idTitulo, \"titulo\")' data-toggle='tooltip' data-placement='top' title='Apagar registro'><i class='bi bi-x-square'></i>&nbsp; Apagar</button>
                            </td>";
                            echo "</tr>";
                          }

                        ?>
                        
                      </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>
</body>
</html>