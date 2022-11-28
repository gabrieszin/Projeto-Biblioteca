<?php

  include('../config/conn.php');
  include_once('../lib/trat-sql.php');

  class locacoes{

    private $connection = null;
    
    public static function retornarIDTituloLocado($idLocacao){
      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{
        
        try{
          $resultados = $connection -> prepare("SELECT cod_titulo FROM locacoes AS l JOIN titulos AS t ON l.cod_titulo = t.id_titulo WHERE id_locacao = :id_locacao LIMIT 1;");
          $resultados -> bindParam(":id_locacao", $idLocacao);
          $resultados -> execute();
          
          foreach($resultados -> fetchAll(PDO::FETCH_ASSOC) as $key => $value){
            $idTitulo = $value['cod_titulo'];
          }

          return $idTitulo;

        }catch(Exception $e){
          echo "Problema na consulta ao Banco de Dados " . $e;
        }
      }
    }

    public static function listarTodosDadosLocacoes($idLocacao){
      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{
        
        try{
          $resultados = $connection -> prepare("SELECT id_locacao, cod_aluno, nome_aluno, cod_titulo, nome_titulo, DATE_FORMAT(dt_locacao, '%d/%m/%Y') AS dt_locacao, DATE_FORMAT(dt_retorno, '%d/%m/%Y') AS dt_retorno, locacao, status_locacao FROM locacoes AS l JOIN alunos AS a ON l.cod_aluno = a.id_aluno JOIN titulos AS t ON l.cod_titulo = t.id_titulo WHERE id_locacao = :id_locacao;");
          $resultados -> bindParam(":id_locacao", $idLocacao);
          $resultados -> execute();
          $exibeResultados = $resultados -> fetchAll(PDO::FETCH_ASSOC);
          $retornoResultados = array();

          foreach($exibeResultados as $key => $value){
            array_push($retornoResultados, $value);
          }

          return $retornoResultados;

        }catch(Exception $e){
          echo "Problema na consulta ao Banco de Dados " . $e;
        }
      }
    }

    public static function listarLocacoes(){
      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{
        
        try{
          $resultados = $connection -> query("SELECT id_locacao, nome_aluno, nome_titulo, DATE_FORMAT(dt_locacao, '%d/%m/%Y') AS dt_locacao, DATE_FORMAT(dt_retorno, '%d/%m/%Y') AS dt_retorno, status_devolucao_locacao, status_locacao FROM locacoes AS l JOIN alunos AS a ON l.cod_aluno = a.id_aluno JOIN titulos AS t ON l.cod_titulo = t.id_titulo WHERE status_locacao = 1;");
          $exibeResultados = $resultados -> fetchAll(PDO::FETCH_ASSOC);
          $retornoResultados = array();

          foreach($exibeResultados as $key => $value){
            array_push($retornoResultados, $value);
          }

          return $retornoResultados;

        }catch(Exception $e){
          echo "Problema na consulta ao Banco de Dados " . $e;
        }
      }
    }

    public static function adicionarLocacao($dadosAdicaoLocacao){
      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{

        try{
          $stringAdicaoLocacao = $connection -> prepare("INSERT INTO locacoes (cod_aluno, cod_titulo, dt_locacao, dt_retorno, status_locacao) VALUES (:cod_aluno, :cod_titulo, :dt_locacao, :dt_retorno, :status_devolucao_locacao)");
          $stringAdicaoLocacao -> bindValue(":cod_aluno", self::tratamento($dadosAdicaoLocacao['selecaoAluno']));
          $stringAdicaoLocacao -> bindValue(":cod_titulo", self::tratamento($dadosAdicaoLocacao['selecaoTitulo']));
          $stringAdicaoLocacao -> bindValue(":dt_locacao", self::tratamento($dadosAdicaoLocacao['inicioLocacao']));
          $stringAdicaoLocacao -> bindValue(":dt_retorno", self::tratamento($dadosAdicaoLocacao['fimLocacao']));
          $stringAdicaoLocacao -> bindValue(":status_devolucao_locacao", self::tratamento($dadosAdicaoLocacao['statusLocacao']));
          $stringAdicaoLocacao -> execute();

          try{
            $resultados = $connection -> prepare("UPDATE titulos SET locacao = 1 WHERE status_titulo = 1 AND id_titulo = :id_titulo");
            $resultados -> bindValue(":id_titulo", self::tratamento($dadosAdicaoLocacao['selecaoTitulo']));
            $resultados -> execute();
  
            return true;
  
          }catch(Exception $e){
            echo "Problema na consulta ao Banco de Dados " . $e;
            return false;
          }

        }catch(PDOException $e){
          echo "Problema na adição do registro no Banco de Dados " . $e;
          return false;
        }catch(Exception $e){
          echo "Erro de execucão do código " . $e;
          return false;
        }
      }
    }

    public static function editarLocacao($idLocacao, $dadosEdicaoLocacao){
      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{

        try{
          $stringEdicaoLocacao = $connection -> prepare("UPDATE locacoes SET 
          cod_aluno = :cod_aluno, cod_titulo = :cod_titulo, dt_locacao = :dt_locacao, dt_retorno = :dt_retorno, status_devolucao_locacao = :status_devolucao_locacao WHERE id_locacao = :id_locacao AND status_locacao = 1");
          $stringEdicaoLocacao -> bindValue(":cod_aluno", self::tratamento($dadosEdicaoLocacao['selecaoAluno']));
          $stringEdicaoLocacao -> bindValue(":cod_titulo", self::tratamento($dadosEdicaoLocacao['selecaoTitulo']));
          $stringEdicaoLocacao -> bindValue(":dt_locacao", self::tratamento($dadosEdicaoLocacao['inicioLocacao']));
          $stringEdicaoLocacao -> bindValue(":dt_retorno", self::tratamento($dadosEdicaoLocacao['fimLocacao']));
          $stringEdicaoLocacao -> bindValue(":status_devolucao_locacao", self::tratamento($dadosEdicaoLocacao['statusLocacao']));
          $stringEdicaoLocacao -> bindValue(":id_locacao", self::tratamento($idLocacao));
          $stringEdicaoLocacao -> execute();

          if($dadosEdicaoLocacao['statusLocacao'] == 0){
            try{
              $resultados = $connection -> prepare("UPDATE titulos SET locacao = 0 WHERE status_titulo = 1 AND id_titulo = :id_titulo");
              $resultados -> bindValue(":id_titulo", self::tratamento($dadosEdicaoLocacao['selecaoTitulo']));
              $resultados -> execute();
    
              return true;
    
            }catch(Exception $e){
              echo "Problema na consulta ao Banco de Dados " . $e;
              return false;
            }
          }else{
            try{
              $resultados = $connection -> prepare("UPDATE titulos SET locacao = 1 WHERE status_titulo = 1 AND id_titulo = :id_titulo");
              $resultados -> bindValue(":id_titulo", self::tratamento($dadosEdicaoLocacao['selecaoTitulo']));
              $resultados -> execute();
    
              return true;
    
            }catch(Exception $e){
              echo "Problema na consulta ao Banco de Dados " . $e;
              return false;
            }
          }

        }catch(PDOException $e){
          echo "Problema na edição do registro no Banco de Dados " . $e;
          return false;
        }catch(Exception $e){
          echo "Erro de execucão do código " . $e;
          return false;
        }
      }
    }

    public static function apagarLocacao($idLocacao){
      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{

        try{
          $stringExclusao = $connection -> prepare("UPDATE locacoes SET status_locacao = 0 WHERE id_locacao = :id_locacao AND status_locacao = 1");
          $stringExclusao -> bindParam(":id_locacao", $idLocacao);
          $stringExclusao -> execute();

          try{

            $idTitulo = locacoes::retornarIDTituloLocado($idLocacao);

            $resultados = $connection -> prepare("UPDATE titulos SET locacao = 0 WHERE status_titulo = 1 AND id_titulo = :id_titulo");
            $resultados -> bindValue(":id_titulo", self::tratamento($idTitulo));
            $resultados -> execute();
  
            return true;
  
          }catch(Exception $e){
            echo "Problema na consulta ao Banco de Dados " . $e;
            return false;
          }

        }catch(PDOException $e){
          echo "Problema na exclusão do registro no Banco de Dados " . $e;
        }catch(Exception $e){
          echo "Erro de execucão do código " . $e;
        }
      }
    }

    public static function listarAlunosTitulosSelecao($tabelaConsulta){
      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{
        
        try{
          if(strtolower($tabelaConsulta) == "alunos"){
            $dadosAlunos = $connection -> query("SELECT id_aluno, nome_aluno FROM alunos WHERE status_aluno = 1");
            $dadosAlunos = $dadosAlunos -> fetchAll(PDO::FETCH_ASSOC);
            $retornoResultadoAlunos = array();
  
            foreach($dadosAlunos as $key => $value){
              array_push($retornoResultadoAlunos, $value);
            }
            return $retornoResultadoAlunos;
          }
        }catch(PDOException $e){
          echo "Problema na exclusão do registro no Banco de Dados " . $e;
        }catch(Exception $e){
          echo "Erro de execucão do código " . $e;
        }

        try{

          if(strtolower($tabelaConsulta) == "titulos"){
            $dadosTitulos = $connection -> query("SELECT id_titulo, nome_titulo FROM titulos WHERE status_titulo = 1 AND locacao = 0");
            $dadosTitulos = $dadosTitulos -> fetchAll(PDO::FETCH_ASSOC);
            $retornoResultadoTitulos = array();

            foreach($dadosTitulos as $key => $value){
              array_push($retornoResultadoTitulos, $value);
            }
            return $retornoResultadoTitulos;
          }
        }catch(PDOException $e){
          echo "Problema na exclusão do registro no Banco de Dados " . $e;
        }catch(Exception $e){
          echo "Erro de execucão do código " . $e;
        }

      }
    }

    public static function verificarExistenciaLocacao($idLocacao){

      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{

        try{
          $verificaExistencia = $connection -> prepare("SELECT id_locacao FROM locacoes WHERE id_locacao = :idLocacao");
          $verificaExistencia -> bindParam(":idLocacao", $idLocacao);
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

?>