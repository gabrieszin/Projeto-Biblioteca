<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adicionar Título</title>
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
    <p>Início -> Lista de Título -> Novo Título</p>
    <div class="botoes mb-3">
      <a href="./titulos.php"><button type="button" class="btn btn-outline-dark" id="btnVoltarHome"><i class="bi bi-arrow-left-square"></i>&nbsp; Voltar</button></a>
    </div>
    <section class="col-md-12">
      <div class="card border-primary">
        <div class="card-header">
          <h5 class="card-title">Adicionar título</h5>
          <p class="card-subtitle text-muted">Adicione um título ao sistema</p>
        </div>
        <div class="card-body">
          <p class="card-text text-muted">
            Preenchimento obrigatório (*)
          </p>

          <form action="../controller/titulos.php" method="POST">

            <div class="form-group mb-3">
              <label for="nomeTitulo" class="form-label preenchimento-obrigatorio">Nome</label>
              <input type="text" class="form-control" id="nomeTitulo" name="nomeTitulo" placeholder="Nome do título" required autofocus>
            </div>

            <div class="form-group">
              <label class="form-label preenchimento-obrigatorio" for="generoTitulo">Gênero</label></br>
              <select class="form-control" name="generoTitulo" id="generoTitulo" required>
                <option value="">Selecione um gênero</option>
                <option value="Fantasia">Fantasia</option>
                <option value="Ficção científica">Ficção científica</option>
                <option value="Distopia">Distopia</option>
                <option value="Ação">Ação</option>
                <option value="Aventura">Aventura</option>
                <option value="Suspense">Suspense</option>
                <option value="Romance">Romance</option>
                <option value="Conto">Conto</option>
              </select>
            </div>

            <!-- <hr> -->

            <section class="titulo-locado" style="display: none;">
              <p><strong class="preenchimento-obrigatorio">Locado</strong></p>

              <div class="form-check">
                <input class="form-check-input" type="radio" value="1" id="tituloDisponivelLocacao" name="statusLocacaoTitulo" required>
                <label class="form-check-label" for="tituloDisponivelLocacao">
                  Sim
                </label>
              </div>
  
              <div class="form-check">
                <input class="form-check-input" type="radio" value="0" id="tituloIndisponivelLocacao" name="statusLocacaoTitulo" required checked>
                <label class="form-check-label" for="tituloIndisponivelLocacao">
                  Não
                </label>
              </div>

              <!-- <hr> -->

              <div style="display: none;">
                <p><strong class="preenchimento-obrigatorio">Status do título</strong></p>

                <div class="form-check">
                  <input class="form-check-input" type="radio" value="1" id="tituloDisponivel" name="statusTitulo" required checked>
                  <label class="form-check-label" for="tituloDisponivel">
                    Ativo
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="radio" value="0" id="tituloIndisponivel" name="statusTitulo" required>
                  <label class="form-check-label" for="tituloIndisponivel">
                    Inativo
                  </label>
                </div>
              </div>
            </section>

            <hr>

            <div class="botoes">
              <button type="submit" class="btn btn-primary" id="btn-enviar-novo-titulo" name="btn-enviar-novo-titulo">Enviar &nbsp;<i class="bi bi-arrow-right-square"></i></button>
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