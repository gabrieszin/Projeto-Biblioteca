<?php

  class connection{
    
    public static $pdo = null;

    public static function oConn(){

      $config = array();
      $config['host'] = 'localhost';
      $config['dbname'] = 'biblioteca';
      $config['dbuser'] = 'root';
      $config['dbpass'] = '';
      $config['charset'] = 'utf8mb4';

      try{
        $pdo = new PDO('mysql:host='. $config['host'] . ';dbname='. $config['dbname'] . ';charset='. $config['charset'], $config['dbuser'], $config['dbpass']);

        if(!$pdo){
          self::closeConn(self::$pdo);
        }

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // echo "Conexão feita com sucesso";
        return $pdo;

      }catch(PDOException $e){
        echo "Erro de conexão com o Banco de Dados " . $e;
      }catch(Exception $e){
        echo "Erro de execução do código " . $e;
      }  
    }

    public static function closeConn($pdo){
      unset($pdo);
    }

  }

  $teste = new connection();
  connection :: oConn();

?>