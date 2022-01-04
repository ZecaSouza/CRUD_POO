<?php

namespace App\db;

use \PDO;

use \PDOException;

class Database{

    // host de conexao com o banco de dados
    const Host = "localhost:3306";

    // nome do banco de dados
    const Name = "vagas_banco";

    // nome do banco
    const User = "root";

    // senha de acesso
    const Pass = "root";

    // nome da tabela a ser manipulada
    private $table;

    //instancia da conexão
    private $connection;


    public function __construct($table = null){
        $this->table = $table;
        $this->setConnection();
    }

    //Metodos para criar conexao com o banco
    private function setConnection(){

        try{
          $this->connection = new PDO("mysql: host=". self::Host.";dbname=". self::Name, self::User, self::Pass);
          $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
          die("ERROR: " . $e->getMessage());
        }
        
    }

    // metodo para executar dados no banco
     public function execute($querry, $parametros = []){

      try{
        $stmt = $this->connection->prepare($querry);
        $stmt->execute($parametros);
        return $stmt;
      }catch(PDOException $e) {
          die("ERROR: " . $e->getMessage());
        }

     }

    //metodo para inserir dados no banco
    public function insert($valores){

      // dados da querry
      $campos = array_keys($valores);
      $binds = array_pad([], count($campos),"?");

      // monta a querry
      $querry = "INSERT INTO " . $this->table. " (".implode(",",$campos).") VALUES (".implode(",",$binds). ")";

      // executa o insert
      $this->execute($querry, array_values($valores));

      // retorna o id inserido
      return $this->connection->lastInsertId();
    }

    // mettodo para atualizar as informacoes do banco de dados
    public function update($where, $values){
      //dados da querry
      $filds = array_keys($values);

      //monta a querry
      $querry = "UPDATE " .$this->table." SET " .implode("=?,", $filds)."=?  WHERE ". $where;

      //executar a querry
      $this->execute($querry, array_values($values));
    }

    // mettodo responsavel por selecionar todas as vagas
    public function select($where = null, $order = null, $limit = null, $filds = "*"){
      //dados
      $where = strlen($where) ? "Where ". $where : "";
      $order = strlen($order) ? "ORDER BY ". $order : "";
      $limit = strlen($limit) ? "LIMIT ". $limit : "";

      // Monta a querry
      $querry = "SELECT ".$filds. " FROM ".$this->table." ".$where." ".$order." ".$limit;

      return $this->execute($querry);
    }

    //metodo responsavel por excluir dados do banco
    public function delete($where){
      //monta a querry
      $querry = "DELETE FROM ". $this->table." WHERE ".$where;

      //executar a querry
      $this->execute($querry);

      //return sucesso
      return true;
    }

}