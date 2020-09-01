<?php

class queryBuilder{
    protected $pdo;
    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    public function makeQuery($query){
        try{
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            return $statement->fetchAll();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    public function selectQueryArr($tableName = "task4", $id){
        try{
            $statement = $this->pdo->prepare("select * from $tableName where id = $id");
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    public function insert($tableName, $parameters){
        $sqlQuery = sprintf(
            'insert into %s (%s) values (%s)',
            $tableName,
            implode(', ',array_keys($parameters)),
            '\''. implode('\', \'',$parameters) . '\''
        );
        try{
            $statement = $this->pdo->prepare($sqlQuery);
            $statement->execute();
        }catch(Exception $e){
            die($e->getMessage());
        }
    }
    public function getPDO()
    {
        return $this->pdo;
    }
}