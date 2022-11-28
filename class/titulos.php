<?php

  include('../config/conn.php');
  include_once('../lib/trat-sql.php');

  class titulos{

    private $connection = null;

    public static function listarTodosDadosTitulos($idTitulo){
      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{

        try{
          $resultados = $connection -> prepare("SELECT id_titulo, nome_titulo, tipo, locacao, status_titulo FROM titulos WHERE id_titulo = :id_titulo AND status_titulo = 1");
          $resultados -> bindParam(":id_titulo", $idTitulo);
          $resultados -> execute();

          $exibeResultados = $resultados -> fetchAll(PDO::FETCH_ASSOC);
          $retornoResultado = array();

          foreach($exibeResultados as $key => $value){
            array_push($retornoResultado, $value);
          }

          return $retornoResultado;

        }catch(Exception $e){
          echo "Problema na consulta ao Banco de Dados " . $e;
        }
      }
    }

    public static function marcarStatusLocado($idTitulo){
      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{

        try{
          $resultados = $connection -> query("UPDATE titulos SET locacao = 1 WHERE status_titulo = 1 AND id_titulo = :id_titulo");
          $resultados -> bindValue(":id_titulo", self::tratamento($idTitulo));
          $resultados -> execute();

          return true;

        }catch(Exception $e){
          echo "Problema na consulta ao Banco de Dados " . $e;
          return false;
        }
      }
    }

    public static function listarTitulos(){
      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{

        try{
          $resultados = $connection -> query("SELECT id_titulo, nome_titulo, tipo, locacao, status_titulo FROM titulos WHERE status_titulo = 1");
          $exibeResultados = $resultados -> fetchAll(PDO::FETCH_ASSOC);
          $retornoResultado = array();

          foreach($exibeResultados as $key => $value){
            array_push($retornoResultado, $value);
          }

          return $retornoResultado;

        }catch(Exception $e){
          echo "Problema na consulta ao Banco de Dados " . $e;
        }
      }
    }

    public static function listarNomeTitulo($idTitulo){
      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{

        try{
          $resultados = $connection -> prepare("SELECT nome_titulo FROM titulos WHERE status_titulo = 1 AND id_titulo = :id_titulo LIMIT 1");
          $resultados -> bindValue(":id_Titulo", self::tratamento($idTitulo));
          $resultados -> execute();

          return $resultados;

        }catch(Exception $e){
          echo "Problema na consulta ao Banco de Dados " . $e;
          return false;
        }
      }
    }

    public static function adicionarTitulo($dadosAdicaoTitulo){
      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{

        try{
          $stringAdicaoTitulo = $connection -> prepare("INSERT INTO titulos (nome_titulo, tipo, locacao, status_titulo) VALUES (:nomeTitulo, :tipoTitulo, :tipoLocacao, :statusTitulo)");
          $stringAdicaoTitulo -> bindValue(":nomeTitulo", self::tratamento($dadosAdicaoTitulo['nomeTitulo']));
          $stringAdicaoTitulo -> bindValue(":tipoTitulo", self::tratamento($dadosAdicaoTitulo['generoTitulo']));
          $stringAdicaoTitulo -> bindValue(":tipoLocacao", self::tratamento($dadosAdicaoTitulo['statusLocacaoTitulo']));
          $stringAdicaoTitulo -> bindValue(":statusTitulo", self::tratamento($dadosAdicaoTitulo['statusTitulo']));
          $stringAdicaoTitulo -> execute();

          // echo "Registro adicionado com sucesso" . "<br>";
          return true;

        }catch(PDOException $e){
          echo "Problema na adição do registro no Banco de Dados " . $e;
          return false;
        }catch(Exception $e){
          echo "Erro de execucão do código " . $e;
          return false;
        }
      }
    }

    public static function editarTitulo(int $idTitulo, $dadosEdicaoTitulo){
      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{

        try{
          $stringEdicaoTitulo = $connection -> prepare("UPDATE titulos SET nome_titulo = :nomeTitulo, tipo = :tipoTitulo, locacao = :locacaoTitulo, status_titulo = :statusTitulo WHERE id_titulo = :id_titulo");
          $stringEdicaoTitulo -> bindValue(":nomeTitulo", self::tratamento($dadosEdicaoTitulo['nomeTitulo']));
          $stringEdicaoTitulo -> bindValue(":tipoTitulo", self::tratamento($dadosEdicaoTitulo['generoTitulo']));
          $stringEdicaoTitulo -> bindValue(":locacaoTitulo", self::tratamento($dadosEdicaoTitulo['statusLocacaoTitulo']));
          $stringEdicaoTitulo -> bindValue(":statusTitulo", self::tratamento($dadosEdicaoTitulo['statusTitulo']));
          $stringEdicaoTitulo -> bindValue(":id_titulo", $idTitulo);
          $stringEdicaoTitulo -> execute();

          // echo "Edição realizada com sucesso" . "<br>";
          return true;

        }catch(PDOException $e){
          echo "Problema na edição do registro no Banco de Dados " . $e;
          return false;
        }catch(Exception $e){
          echo "Erro de execucão do código " . $e;
          return false;
        }
      }
    }

    public static function apagarTitulo(int $idTitulo){
      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{

        try{
          $stringExclusao = $connection -> prepare("UPDATE titulos SET status_titulo = 0 WHERE id_titulo = :id_titulo");
          $stringExclusao -> bindParam(":id_titulo", $idTitulo);
          $stringExclusao -> execute();

          // echo "Exclusão do registro realizada com sucesso" . "<br>";

        }catch(PDOException $e){
          echo "Problema na exclusão do registro no Banco de Dados " . $e;
        }catch(Exception $e){
          echo "Erro de execucão do código " . $e;
        }
      }
    }

    public static function verificarExistenciaTitulo($idTitulo){
      
      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{

        try{
          $verificaExistencia = $connection -> prepare("SELECT id_titulo FROM titulos WHERE id_titulo = :idTitulo");
          $verificaExistencia -> bindParam(":idTitulo", $idTitulo);
          $verificaExistencia -> execute();
  
          $verificaExistencia = $verificaExistencia -> fetchAll(PDO::FETCH_ASSOC);
          $retorno = false;
  
          if(empty($verificaExistencia) || $verificaExistencia == "" || $verificaExistencia == null){
            $retorno = false;
          }else{
            $retorno = true;
          }
          
          return $retorno;
        }catch(PDOException $e){
          echo "Problema na consulta ao Banco de Dados " . $e;
        }catch(Exception $e){
          echo "Erro de execucão do código " . $e;
        }
      }
    }

    private static function tratamento($str){
      $tratamentoSQL = new tratamentoSQL();
      $str = tratamentoSQL::removerCaractereEsp($str);
      return $str;
    }
  }

  // $teste = new titulos;
  // titulos::listarTitulos();

?>