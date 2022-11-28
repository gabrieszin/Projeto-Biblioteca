<?php

  class tratamentoSQL{
    public static function removerCaractereEsp($str){
      $result = str_replace(array("#", "'", ";", ".", "=", "*", "/", "+", "?", "!","&", "_"), '', $str);
      return $result;
    }

    public static function removerPalavrasEsp($str){
      $search = array('[vazio]');
      $str = strtolower($str);

      for($i = 0; $i < count($search); $i++){
        if(strpos($str, $search[$i]) !== false){
          $posicaoInicioPalavra = strpos($str, $search[$i]);

          if($str[($posicaoInicioPalavra - 1)] == "" && $str[($posicaoInicioPalavra + strlen($search[$i]))] !== " " || empty($str[($posicaoInicioPalavra + strlen($search[$i]))])){
            $strSaida = str_replace($search[$i], '**', $str);
          }else{
            $strSaida = $str;
          }

        }else{
          $strSaida = $str;
        }
        return $strSaida;
      }
    }
  }

  // $str = "";
  // $class = new tratamentoSQL();
  // echo tratamentoSQL::removerCaractereEsp($str);

?>