<?php

  if(isset($_POST['tituloAtividade'])){
    $errors = 'Não enviou';
  }

  echo json_encode($errors);

?>