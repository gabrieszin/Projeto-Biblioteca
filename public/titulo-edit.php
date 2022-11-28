<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Título</title>
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
    $idTitulo = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $idTitulo = intval($idTitulo);

    include('../class/titulos.php');
    $titulos = new titulos();
    $consultaExistencia = titulos::verificarExistenciaTitulo($idTitulo);

    if($consultaExistencia){
      // echo $_GET['id'];
      // echo "recebeu";
      $dadosTitulo = titulos::listarTodosDadosTitulos($idTitulo);
      $nomeTitulo = null;
      $tipoTitulo = null;
      $locacaoTitulo = null;
      $statusTitulo = null;

      foreach($dadosTitulo as $key => $value){
        $nomeTitulo = htmlentities($value['nome_titulo']);
        $tipoTitulo = htmlentities($value['tipo']);
        $locacaoTitulo = htmlentities($value['locacao']);
        $statusTitulo = htmlentities($value['status_titulo']);
      }

    }else{
      header("Refresh: 3, url= titulos.php");
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
    <p>Início -> Lista de Título -> Editar Título</p>
    <div class="botoes mb-3">
      <a href="./titulos.php"><button type="button" class="btn btn-outline-dark" id="btnVoltarHome"><i class="bi bi-arrow-left-square"></i>&nbsp; Voltar</button></a>
    </div>
    <section class="col-md-12">
      <div class="card border-primary">
        <div class="card-header">
          <h5 class="card-title">Editar título</h5>
          <p class="card-subtitle text-muted">Edite um título ao sistema</p>
        </div>
        <div class="card-body">
          <p class="card-text text-muted">
            Preenchimento obrigatório (*)
          </p>

          <form action="../controller/titulos.php" method="POST">

            <div class="form-group mb-3">
              <input type="hidden" class="" id="s-i-titulos" name="s-i-titulos" value="<?php echo $idTitulo; ?>">
              <label for="nomeTitulo" class="form-label preenchimento-obrigatorio">Nome</label>
              <input type="text" class="form-control" id="nomeTitulo" name="nomeTitulo" placeholder="Nome do título" required autofocus <?php echo "value='$nomeTitulo'" ?>>
            </div>
            
            <div class="form-group">
              <label class="form-label preenchimento-obrigatorio" for="generoTitulo">Gênero</label></br>
              <select class="form-control" name="generoTitulo" id="generoTitulo" required>

                <option value="">Selecione um gênero</option>
                
                <option value="Fantasia" 
                  <?php $situacao = $tipoTitulo == "Fantasia" ? "selected" : ""; echo $situacao; ?>
                  >Fantasia
                </option>

                <option value="Ficção científica" 
                  <?php $situacao = $tipoTitulo == "Ficção científica" ? "selected" : ""; echo $situacao; ?>
                  >Ficção científica
                </option>
                
                <option value="Distopia" 
                  <?php $situacao = $tipoTitulo == "Distopia" ? "selected" : ""; echo $situacao; ?>
                  >Distopia
                </option>
                
                <option value="Ação" 
                  <?php $situacao = $tipoTitulo == "Ação" ? "selected" : ""; echo $situacao; ?>
                  >Ação
                </option>
                
                <option value="Aventura" 
                  <?php $situacao = $tipoTitulo == "Aventura" ? "selected" : ""; echo $situacao; ?>
                  >Aventura
                </option>
                
                <option value="Suspense" 
                  <?php $situacao = $tipoTitulo == "Suspense" ? "selected" : ""; echo $situacao; ?>
                  >Suspense
                </option>
                
                <option value="Romance" 
                  <?php $situacao = $tipoTitulo == "Romance" ? "selected" : ""; echo $situacao; ?>
                  >Romance
                </option>
                
                <option value="Conto" 
                  <?php $situacao = $tipoTitulo == "Conto" ? "selected" : ""; echo $situacao; ?>
                  >Conto
                </option>
              </select>
            </div>

            <hr>

            <section class="matricula">
              <p><strong class="preenchimento-obrigatorio">Locado</strong></p>

              <div class="form-check">
                <input class="form-check-input" type="radio" value="1" id="tituloDisponivelLocacao" name="statusLocacaoTitulo" required <?php $situacao = $locacaoTitulo == 1 ? "checked" : ""; echo $situacao; ?> disabled>
                <label class="form-check-label" for="tituloDisponivelLocacao">
                  Sim
                </label>
              </div>
  
              <div class="form-check">
                <input class="form-check-input" type="radio" value="0" id="tituloIndisponivelLocacao" name="statusLocacaoTitulo" required <?php $situacao = $locacaoTitulo == 0 ? "checked" : ""; echo $situacao; ?> disabled>
                <label class="form-check-label" for="tituloIndisponivelLocacao">
                  Não
                </label>

                <input type="hidden" name="statusLocacaoTitulo" value="<?php $situacao = $locacaoTitulo == 1 ? "1" : "0"; echo $situacao; ?>">
              </div>

              <hr>

              <p><strong class="preenchimento-obrigatorio">Status do título</strong></p>

              <div class="form-check">
                <input class="form-check-input" type="radio" value="1" id="tituloDisponivel" name="statusTitulo" required <?php $situacao = $statusTitulo == 1 ? "checked" : ""; echo $situacao; ?>>
                <label class="form-check-label" for="tituloDisponivel">
                  Ativo
                </label>
              </div>
  
              <div class="form-check">
                <input class="form-check-input" type="radio" value="0" id="tituloIndisponivel" name="statusTitulo" required <?php $situacao = $statusTitulo == 0 ? "checked" : ""; echo $situacao; ?>>
                <label class="form-check-label" for="tituloIndisponivel">
                  Inativo
                </label>
              </div>
            </section>

            <hr>

            <div class="botoes">
              <button type="submit" class="btn btn-primary" id="btn-enviar-edicao-titulo" name="btn-enviar-edicao-titulo">Enviar &nbsp;<i class="bi bi-arrow-right-square"></i></button>
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