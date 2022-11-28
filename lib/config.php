<?php

// URL base do projeto
define("URL_ATUAL", getBaseUrl());

// detectar o navegador do usuário em PHP
define("NAVEGADOR", $_SERVER['HTTP_USER_AGENT']);

// servidor web
define("SERV_WEB", $_SERVER['SERVER_SOFTWARE']);

// diretório atual do projeto
define("DIR_ATUAL_PROJETO", $_SERVER['REQUEST_URI']);

// porta utilizada no projeto
define("PORTA", $_SERVER['SERVER_PORT']);

// nome da estação local
define("NOME_ESTACAO", gethostbyaddr($_SERVER['REMOTE_ADDR']));







// função para capturar URL base do projeto
function getBaseUrl($array=false) {
  $protocol = "";
  $host = "";
  $port = "";
  $dir = "";  

  // capturar protocolo
  if(array_key_exists("HTTPS", $_SERVER) && $_SERVER["HTTPS"] != "") {
      if($_SERVER["HTTPS"] == "on") { $protocol = "https"; }
      else { $protocol = "http"; }
  } elseif(array_key_exists("REQUEST_SCHEME", $_SERVER) && $_SERVER["REQUEST_SCHEME"] != "") { $protocol = $_SERVER["REQUEST_SCHEME"]; }

  // capturar estação host
  if(array_key_exists("HTTP_X_FORWARDED_HOST", $_SERVER) && $_SERVER["HTTP_X_FORWARDED_HOST"] != "") { $host = trim(end(explode(',', $_SERVER["HTTP_X_FORWARDED_HOST"]))); }
  elseif(array_key_exists("SERVER_NAME", $_SERVER) && $_SERVER["SERVER_NAME"] != "") { $host = $_SERVER["SERVER_NAME"]; }
  elseif(array_key_exists("HTTP_HOST", $_SERVER) && $_SERVER["HTTP_HOST"] != "") { $host = $_SERVER["HTTP_HOST"]; }
  elseif(array_key_exists("SERVER_ADDR", $_SERVER) && $_SERVER["SERVER_ADDR"] != "") { $host = $_SERVER["SERVER_ADDR"]; }
  //elseif(array_key_exists("SSL_TLS_SNI", $_SERVER) && $_SERVER["SSL_TLS_SNI"] != "") { $host = $_SERVER["SSL_TLS_SNI"]; }

  // capturar porta
  if(array_key_exists("SERVER_PORT", $_SERVER) && $_SERVER["SERVER_PORT"] != "") { $port = $_SERVER["SERVER_PORT"]; }
  elseif(stripos($host, ":") !== false) { $port = substr($host, (stripos($host, ":")+1)); }
  
  // remover porta do host
  $host = preg_replace("/:\d+$/", "", $host);

  // capturar o diretório
  if(array_key_exists("SCRIPT_NAME", $_SERVER) && $_SERVER["SCRIPT_NAME"] != "") { $dir = $_SERVER["SCRIPT_NAME"]; }
  elseif(array_key_exists("PHP_SELF", $_SERVER) && $_SERVER["PHP_SELF"] != "") { $dir = $_SERVER["PHP_SELF"]; }
  elseif(array_key_exists("REQUEST_URI", $_SERVER) && $_SERVER["REQUEST_URI"] != "") { $dir = $_SERVER["REQUEST_URI"]; }
  
  // encurtar para o diretório principal
  if(stripos($dir, "/") !== false) { $dir = substr($dir, 0, (strripos($dir, "/")+1)); }

  // criar o valor de retorno
  if(!$array) {
      if($port == "80" || $port == "443" || $port == "") { $port = ""; }
      else { $port = ":".$port; } 
      return htmlspecialchars($protocol."://".$host.$port.$dir, ENT_QUOTES); 
  } else { return ["protocol" => $protocol, "host" => $host, "port" => $port, "dir" => $dir]; }
}