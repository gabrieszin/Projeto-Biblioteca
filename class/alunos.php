<?php

  include('../config/conn.php');
  include_once('../lib/trat-sql.php');

  class alunos{

    private $connection = null;

    public function __construct(){
      return "alunos";
    }

    public static function listarTodosDadosAlunos($idAluno){
      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{

        try{

          $resultados = $connection -> prepare("SELECT nome_aluno, telefone, endereco, bairro, numero, complemento, cidade, cep, uf, referencia, dt_nascimento, status_aluno FROM alunos WHERE id_aluno = :idAluno AND status_aluno = 1");
          $resultados -> bindParam(":idAluno", $idAluno);
          $resultados -> execute();

          $exibeResultados = $resultados -> fetchAll(PDO::FETCH_ASSOC);
          $retornoResultado = array();

          foreach($exibeResultados as $key => $value){
            array_push($retornoResultado, $value);
          }

          return $retornoResultado;

        }catch(PDOException $e){
          echo "Problema na consulta ao Banco de Dados " . $e;
        }catch(Exception $e){
          echo "Erro de execucão do código " . $e;
        }
      }
    }

    public static function listarAlunos(){
      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{

        try{
          $resultados = $connection -> query("SELECT id_aluno, nome_aluno, telefone, status_aluno FROM alunos WHERE status_aluno = 1");
          $exibeResultados = $resultados -> fetchAll(PDO::FETCH_ASSOC);
          $retornoResultado = array();

          foreach($exibeResultados as $key => $value){
            array_push($retornoResultado, $value);
          }

          return $retornoResultado;

        }catch(PDOException $e){
          echo "Problema na consulta ao Banco de Dados " . $e;
        }catch(Exception $e){
          echo "Erro de execucão do código " . $e;
        }
      }
    }

    public static function adicionarAluno($dadosAdicaoAluno){
      $connection = connection::oConn();
      
      if(!$connection){
        connection::closeConn($connection);
      }else{

        try{
          
          $stringAdicaoAluno = $connection -> prepare("INSERT INTO alunos (nome_aluno, telefone, endereco, bairro, numero, complemento, cidade, cep, uf, referencia, dt_nascimento, dt_criacao, status_aluno) VALUES (:nomeAluno, :telefoneAluno, :enderecoAluno, :bairroAluno, :numeroAluno, :complementoAluno, :cidadeAluno, :cepAluno, :ufAluno, :referenciaAluno, :dt_nascimentoAluno, :dt_criacaoAluno, :status_alunoAluno)");
          $stringAdicaoAluno -> bindValue(":nomeAluno", self::tratamento($dadosAdicaoAluno['nomeAluno']));
          $stringAdicaoAluno -> bindValue(":telefoneAluno", self::tratamento($dadosAdicaoAluno['celularAluno']));
          $stringAdicaoAluno -> bindValue(":enderecoAluno", self::tratamento($dadosAdicaoAluno['rua']));
          $stringAdicaoAluno -> bindValue(":bairroAluno", self::tratamento($dadosAdicaoAluno['bairro']));
          $stringAdicaoAluno -> bindValue(":numeroAluno", self::tratamento($dadosAdicaoAluno['numeroCasaAluno']));
          $stringAdicaoAluno -> bindValue(":complementoAluno", self::tratamento($dadosAdicaoAluno['complementoCasaAluno']));
          $stringAdicaoAluno -> bindValue(":cidadeAluno", self::tratamento($dadosAdicaoAluno['cidade']));
          $stringAdicaoAluno -> bindValue(":cepAluno", self::tratamento($dadosAdicaoAluno['cepAluno']));
          $stringAdicaoAluno -> bindValue(":ufAluno", self::tratamento($dadosAdicaoAluno['uf']));
          $stringAdicaoAluno -> bindValue(":referenciaAluno", self::tratamento($dadosAdicaoAluno['pontoDeReferencia']));
          $stringAdicaoAluno -> bindValue(":dt_nascimentoAluno", self::tratamento($dadosAdicaoAluno['dataNascimento']));
          $stringAdicaoAluno -> bindValue(":dt_criacaoAluno", self::tratamento($dadosAdicaoAluno['dataCriacao']));
          $stringAdicaoAluno -> bindValue(":status_alunoAluno", self::tratamento($dadosAdicaoAluno['statusAluno']));
          $stringAdicaoAluno -> execute();

          return true;
          // echo "Registro adicionado com sucesso" . "<br>";

        }catch(PDOException $e){
          echo "Problema na adição do registro no Banco de Dados " . $e;
          return false;
        }catch(Exception $e){
          echo "Erro de execucão do código " . $e;
          return false;
        }
      }
    }

    public static function editarAluno(int $idAluno, $dadosEdicaoAluno){
      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{

        try{
          $stringEditarAluno = $connection -> prepare("UPDATE alunos SET nome_aluno = :nomeAluno, telefone = :telefoneAluno, endereco = :enderecoAluno, bairro = :bairroAluno, numero = :numeroAluno, complemento = :complementoAluno, cidade = :cidadeAluno, cep = :cepAluno, uf = :ufAluno, referencia = :referenciaAluno, dt_nascimento = :dt_nascimentoAluno, status_aluno = :status_alunoAluno WHERE id_aluno = :id_aluno");
          $stringEditarAluno -> bindValue(":nomeAluno", self::tratamento($dadosEdicaoAluno['nomeAluno']));
          $stringEditarAluno -> bindValue(":telefoneAluno", self::tratamento($dadosEdicaoAluno['celularAluno']));
          $stringEditarAluno -> bindValue(":enderecoAluno", self::tratamento($dadosEdicaoAluno['rua']));
          $stringEditarAluno -> bindValue(":bairroAluno", self::tratamento($dadosEdicaoAluno['bairro']));
          $stringEditarAluno -> bindValue(":numeroAluno", self::tratamento($dadosEdicaoAluno['numeroCasaAluno']));
          $stringEditarAluno -> bindValue(":complementoAluno", self::tratamento($dadosEdicaoAluno['complementoCasaAluno']));
          $stringEditarAluno -> bindValue(":cidadeAluno", self::tratamento($dadosEdicaoAluno['cidade']));
          $stringEditarAluno -> bindValue(":cepAluno", self::tratamento($dadosEdicaoAluno['cepAluno']));
          $stringEditarAluno -> bindValue(":ufAluno", self::tratamento($dadosEdicaoAluno['uf']));
          $stringEditarAluno -> bindValue(":referenciaAluno", self::tratamento($dadosEdicaoAluno['pontoDeReferencia']));
          $stringEditarAluno -> bindValue(":dt_nascimentoAluno", self::tratamento($dadosEdicaoAluno['dataNascimento']));
          $stringEditarAluno -> bindValue(":status_alunoAluno", self::tratamento($dadosEdicaoAluno['statusAluno']));
          $stringEditarAluno -> bindValue(":id_aluno", $idAluno);
          $stringEditarAluno -> execute();

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

    public static function apagarAluno($idAluno){
      $connection = connection::oConn();
      $retorno = false;

      if(!$connection){
        connection::closeConn($connection);
      }else{

        try{
          $stringExclusao = $connection -> prepare("UPDATE alunos SET status_aluno = 0 WHERE id_aluno = :id_aluno AND status_aluno = 1");
          $stringExclusao -> bindParam(":id_aluno", $idAluno);
          $stringExclusao -> execute();

          // echo "Exclusão do registro realizada com sucesso" . "<br>";
          $retorno = true;
        }catch(PDOException $e){
          echo "Problema na exclusão do registro no Banco de Dados " . $e;
          $retorno = false;
        }catch(Exception $e){
          echo "Erro de execucão do código " . $e;
          $retorno = false;
        }
      }
      return $retorno;
    }
    
    public static function listarLivrosLocadosAluno($idAluno){
      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{

        try{
          $listaLivrosLocados = $connection -> prepare("SELECT id_locacao, nome_titulo, dt_locacao FROM locacoes AS l JOIN titulos AS t ON l.cod_titulo = t.id_titulo WHERE cod_aluno = :idAluno ORDER BY id_locacao DESC, dt_locacao DESC LIMIT 1");
          $listaLivrosLocados -> bindParam(":idAluno", $idAluno);
          $listaLivrosLocados -> execute();
  
          $exibeListaLivrosLocados = $listaLivrosLocados -> fetchAll(PDO::FETCH_ASSOC);
          $retornoResultado = array();
  
          foreach($exibeListaLivrosLocados as $key => $value){
            array_push($retornoResultado, $value);
          }
  
          return $retornoResultado; 
        }catch(PDOException $e){
          echo "Problema na consulta ao Banco de Dados " . $e;
        }catch(Exception $e){
          echo "Erro de execucão do código " . $e;
        }
      }
    }

    public static function verificarExistenciaAluno($idAluno){
      $connection = connection::oConn();

      if(!$connection){
        connection::closeConn($connection);
      }else{

        try{
          $verificaExistencia = $connection -> prepare("SELECT id_aluno FROM alunos WHERE id_aluno = :idAluno");
          $verificaExistencia -> bindParam(":idAluno", $idAluno);
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

  // $teste = new alunos;
  // print_r(alunos::listarLivrosLocadosAluno(1));
  // alunos::listarAlunos();
  // alunos::apagarAluno(numeroIDAluno);

?>