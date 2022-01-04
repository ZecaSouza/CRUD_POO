<?php

namespace App\Entidade;

use \App\db\database;

use \PDO;

class Vaga{

    //identificador da vaga tipo integer
    public $id;

    // titulo da vaga
    public $titulo;

    // Descricao da vaga tipo string
    public $descricao;

    // define se a vaga esta ativa ou inativa (s/n)
    public $ativo;

    // data de publicação da vaga
    public $data;

    //metodo responsavel por cadastrar a  nova vaga
    public function cadastrar(){
        // definir data
        $this->data = date("Y-m-d H:i:s");

        //inserir a vaga no banco
        $obDatabase = new Database("vagas");
        $this->id = $obDatabase->insert ( [
                                        "titulo" => $this->titulo,
                                        "descricao" => $this->descricao,
                                        "ativo" => $this->ativo,
                                        "data" => $this->data
                                ] );
        // retornar sucesso
        return true;
    }

    public function atualizar(){
        return (new Database("vagas"))->update("id = ".$this->id,[
                                                    "titulo" => $this->titulo,
                                                    "descricao" => $this->descricao,
                                                    "ativo" => $this->ativo,
                                                    "data" => $this->data
                                                ]);
    }

    // metodo responsvael por excluir a vaga no banco
    public function excluir(){
        return (new Database("vagas"))->delete("id=". $this->id);
    }

    // metodo responsavel por obter as vagas do banco de dados
    public static function getVagas($where = null, $order = null, $limit = null){
        return (new Database("vagas"))->select($where, $order, $limit)
                                      ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    //Metodo responsavel por buscar uma vaga com base no seu id
    public static function getVaga($id){
        return (new Database("vagas"))->select("id = ".$id)
                                      ->fetchObject(self::class);
      }
    
}