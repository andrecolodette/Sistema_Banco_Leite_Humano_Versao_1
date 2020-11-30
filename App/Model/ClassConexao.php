<?php

namespace App\Model;

abstract class ClassConexao
{
    private $con;

    #Realiza a conexão com o DB
    protected function conectaDB()
    {
        try{
            $this->con=new \PDO("mysql:host=".HOST.";dbname=".DB.";charset=utf8","".USER."","".PASSWORD."");
            $this->con->exec("SET NAMES 'utf8'");
            return $this->con;
        }catch (\PDOException $erro){
            return $erro->getMessage();
        }
    }

    protected function getLastID()
    {
        return $this->con->lastInsertId();
    }

}
