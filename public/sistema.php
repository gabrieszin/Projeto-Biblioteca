<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema :: Projeto Modelo</title>
  <link rel="shortcut icon" href="./imagens/logo.svg" type="image/x-icon">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/stylesistema.css">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./javascript/script.js"></script>
</head>
<body>

  <nav class="darkbutton">
    <div class="theme-switch-wrapper">
         <label class="theme-switch" for="checkbox">
      <input type="checkbox" id="checkbox" />
      <div class="slider round"></div>
    </label>
      <em></em>
    </div>
  </nav> 

  <div class="container">
    <div style="cursor: hand;" onclick="location.href='./alunos.php'">  
      <div class="card">
        <div class="card-header">
          <img src="imagens/alunos.jpg" alt="rover" />
        </div>
        <div class="card-body">
          <div class="user">
            <span><a class="titulos">Alunos</a></span>
            </div>
          </div>
        </div>
    </div>
  </div>


  <div class="container">
    <div style="cursor: hand;" onclick="location.href='./titulos.php'">  
      <div class="card">
        <div class="card-header">
          <img src="imagens/titulos.jpg" alt="rover" />
        </div>
        <div class="card-body">
          <div class="user">
            <span><a class="titulos">Títulos</a></span>
            </div>
          </div>
        </div>
    </div>
  </div>

  <div class="container">
    <div style="cursor: hand;" onclick="location.href='./locacoes.php'">  
      <div class="card">
        <div class="card-header">
          <img src="imagens/locações.jpg" alt="rover" />
        </div>
        <div class="card-body">
          <div class="user">
            <span><a class="titulos">Locações</a></span>
            </div>
          </div>
        </div>
    </div>
  </div>

  <script type="text/javascript" src="./javascript/darkmode.js"></script>
   
</body>
</html>