<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Locações</title>
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
include_once("../class/locacoes.php");

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-enviar-nova-locacao'])){
    
  try{

    $dadosLocacao = array(
      "selecaoAluno" => filter_input(INPUT_POST, 'selecaoAluno', FILTER_SANITIZE_NUMBER_INT),
      "selecaoTitulo" => filter_input(INPUT_POST, 'selecaoTitulo', FILTER_SANITIZE_NUMBER_INT),
      "inicioLocacao" => filter_input(INPUT_POST, 'inicioLocacao', FILTER_SANITIZE_SPECIAL_CHARS),
      "fimLocacao" => filter_input(INPUT_POST, 'fimLocacao', FILTER_SANITIZE_SPECIAL_CHARS),
      "statusLocacao" => filter_input(INPUT_POST, 'statusLocacao', FILTER_SANITIZE_NUMBER_INT)
    );

    if(locacoes::adicionarLocacao($dadosLocacao)){
      header("Refresh: 1.5, url=../public/locacoes.php");
      echo "
      <script>
        Swal.fire({
          icon: 'success', 
          title: 'Sucesso!', 
          text: 'A locação foi adicionada com sucesso. Redirecionando...', 
          timer: 1500
        });
      </script>";
      exit();
    }

  }catch(Exception $e){
    header("Location:../public/locacoes.php");
    echo "<script> 
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Não foi possível enviar o formulário. Tente novamente mais tarde',
        timer: 1500
      })
      </script>";
  }
  exit();
}

else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btn-enviar-edicao-locacao'])){
  $idLocacao = filter_input(INPUT_POST, 's-i-locacoes', FILTER_SANITIZE_NUMBER_INT);
  $idLocacao = intval($idLocacao);
  $consultaExistencia = locacoes::verificarExistenciaLocacao($idLocacao);
  $dadosLocacao = array(
    "selecaoAluno" => filter_input(INPUT_POST, 'selecaoAluno', FILTER_SANITIZE_NUMBER_INT),
    "selecaoTitulo" => filter_input(INPUT_POST, 'selecaoTitulo', FILTER_SANITIZE_NUMBER_INT),
    "inicioLocacao" => filter_input(INPUT_POST, 'inicioLocacao', FILTER_SANITIZE_SPECIAL_CHARS),
    "fimLocacao" => filter_input(INPUT_POST, 'fimLocacao', FILTER_SANITIZE_SPECIAL_CHARS),
    "statusLocacao" => filter_input(INPUT_POST, 'statusLocacao', FILTER_SANITIZE_NUMBER_INT)
  );
  
  try{
    
    if(locacoes::editarLocacao($idLocacao, $dadosLocacao)){
      header("Refresh: 1.5, url= ../public/locacoes.php");
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
      header("Refresh: 3, url= ../public/locacoes.php");
      echo "
      <script> 
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Não foi possível enviar o formulário. Tente novamente mais tarde',
          timer: 3000
        })
      </script>";
      exit();
    }

  }catch(Exception $e){
    header("Refresh: 3, url= ../public/locacoes.php");
    echo "
    <script> 
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Não foi possível enviar o formulário. Tente novamente mais tarde',
        timer: 3000
      })
    </script>";
    exit();
  }
  exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['apagar-registro-locacao'])){
  $idLocacao = filter_input(INPUT_POST, 'apagar-registro-locacao', FILTER_SANITIZE_NUMBER_INT);
  $locacao = new locacoes();

  $consultaExistencia = locacoes::verificarExistenciaLocacao($idLocacao);

  if($consultaExistencia){
    locacoes::apagarLocacao($idLocacao);
    header("Refresh: 1.5, url= ../public/locacoes.php");
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
    header("Refresh: 3, url= ../public/locacoes.php");
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

else{
  header("Location: ../public/locacoes.php");
}

?>