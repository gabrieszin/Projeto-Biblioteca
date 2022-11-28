<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alunos</title>
  <link rel="shortcut icon" href="../public/imagens/logo.svg" type="image/x-icon">
  <link rel="stylesheet" href="../public/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../public/javascript/script.js"></script>
</head>
<body>

<?php

require("../lib/parametros-basicos-cabecalho.php");
include_once("../class/alunos.php");

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-enviar-novo-aluno'])){
    
  require("../lib/parametros-basicos-cabecalho.php");
  
  try{
    $dadosEnvio = array(
      "nomeAluno" => filter_input(INPUT_POST, 'nomeAluno', FILTER_SANITIZE_SPECIAL_CHARS),
      "dataNascimento" => filter_input(INPUT_POST, 'dataNascimento', FILTER_SANITIZE_SPECIAL_CHARS), 
      "celularAluno" => filter_input(INPUT_POST, 'celularAluno', FILTER_SANITIZE_SPECIAL_CHARS), 
      "cepAluno" => filter_input(INPUT_POST, 'cepAluno', FILTER_SANITIZE_SPECIAL_CHARS),
      "numeroCasaAluno" => filter_input(INPUT_POST, 'numeroCasaAluno', FILTER_SANITIZE_SPECIAL_CHARS),
      "endereco-sem-numero]" => filter_input(INPUT_POST, 'endereco-sem-numero', FILTER_SANITIZE_NUMBER_INT),
      "complementoCasaAluno" => filter_input(INPUT_POST, 'complementoCasaAluno', FILTER_SANITIZE_SPECIAL_CHARS), 
      "rua" => filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_SPECIAL_CHARS),
      "bairro" => filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS),
      "cidade" => filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS),
      "uf" => filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_SPECIAL_CHARS), 
      "pontoDeReferencia" => filter_input(INPUT_POST, 'pontoDeReferencia', FILTER_SANITIZE_SPECIAL_CHARS), 
      "dataCriacao" => filter_input(INPUT_POST, 'dataCriacao', FILTER_SANITIZE_SPECIAL_CHARS), 
      "statusAluno" => filter_input(INPUT_POST, 'statusAluno', FILTER_SANITIZE_SPECIAL_CHARS)
    );

    if(alunos::adicionarAluno($dadosEnvio)){
      header("Refresh: 1.5, url=../public/alunos.php");
      echo "
      <script>
        Swal.fire({
          icon: 'success', 
          title: 'Sucesso!', 
          text: 'O aluno foi adicionado com sucesso. Redirecionando...', 
          timer: 1500
        });
      </script>";
      exit();
    }

  }catch(Exception $e){
    // header("Location: sistema.html");
    header("Refresh: 3, url=../public/alunos.php");
    echo "<script> 
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Não foi possível enviar o formulário. Tente novamente mais tarde. Redirecionando...',
        timer: 3000
      })
      </script>";
    exit();
  }
  exit();
}

else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['apagar-registro-estudante'])){
  $idAluno = filter_input(INPUT_POST, 'apagar-registro-estudante', FILTER_SANITIZE_NUMBER_INT);

  $consultaExistencia = alunos::verificarExistenciaAluno($idAluno);

  if($consultaExistencia){
    alunos::apagarAluno($idAluno);
    header("Refresh: 1.5, url=../public/alunos.php");
    echo "      
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Tudo certo',
        text: 'Registro apagado. Redirecionando...',
        timer: 1500
      });
    </script>";
    exit();
  }else{
    header("Refresh: 3, url=../public/alunos.php");
    echo "
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Houve um erro',
        text: 'Não foi encontrado o registro para apagar. Redirecionando...',
        timer: 3000
      });
    </script>";
    exit();
  }

}

else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-enviar-edicao-aluno'])){
  $idAluno = filter_input(INPUT_POST, 's-i-alunos', FILTER_SANITIZE_NUMBER_INT);
  $idAluno = intval($idAluno);
  
  $dadosEnvio = array(
    "nomeAluno" => filter_input(INPUT_POST, 'nomeAluno', FILTER_SANITIZE_SPECIAL_CHARS),
    "dataNascimento" => filter_input(INPUT_POST, 'dataNascimento', FILTER_SANITIZE_SPECIAL_CHARS), 
    "celularAluno" => filter_input(INPUT_POST, 'celularAluno', FILTER_SANITIZE_SPECIAL_CHARS), 
    "cepAluno" => filter_input(INPUT_POST, 'cepAluno', FILTER_SANITIZE_SPECIAL_CHARS),
    "numeroCasaAluno" => filter_input(INPUT_POST, 'numeroCasaAluno', FILTER_SANITIZE_SPECIAL_CHARS),
    "endereco-sem-numero]" => filter_input(INPUT_POST, 'endereco-sem-numero', FILTER_SANITIZE_NUMBER_INT),
    "complementoCasaAluno" => filter_input(INPUT_POST, 'complementoCasaAluno', FILTER_SANITIZE_SPECIAL_CHARS), 
    "rua" => filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_SPECIAL_CHARS),
    "bairro" => filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS),
    "cidade" => filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS),
    "uf" => filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_SPECIAL_CHARS), 
    "pontoDeReferencia" => filter_input(INPUT_POST, 'pontoDeReferencia', FILTER_SANITIZE_SPECIAL_CHARS), 
    "statusAluno" => filter_input(INPUT_POST, 'statusAluno', FILTER_SANITIZE_SPECIAL_CHARS)
  );

  try{
    if(alunos::editarAluno($idAluno, $dadosEnvio)){
      header("Refresh: 1.5, url=../public/alunos.php");
      echo "      
      <script>
      Swal.fire({
        icon: 'success',
        title: 'Tudo certo', 
        text: 'Dados atualizados. Redirecionando...',
        timer: 1500
      });
      </script>";
      exit();
    }else{
      header("Refresh: 3, url=../public/alunos.php");
      echo "<script> 
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Não foi possível enviar o formulário. Tente novamente mais tarde. Redirecionando...',
          timer: 3000
        })
        </script>";
      exit();
    }
  }catch(Exception $e){
    header("Refresh: 3, url=../public/alunos.php");
    echo "<script> 
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Não foi possível enviar o formulário. Tente novamente mais tarde. Redirecionando...',
        timer: 3000
      })
      </script>";
      exit();
    }
  exit();

}

else{
  header("Location: ../public/alunos.php");
}

?>



</body>