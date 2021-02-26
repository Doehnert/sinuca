<?php
namespace App\Core\Database;
class QueryBuilder {
    protected $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function selectCount($table) {
        $sql = "select count(*) from {$table}";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetch() [0];
    }

    public function deleteOne($table, $param, $id)
    {
        $sql = "DELETE FROM {$table} WHERE {$param} = {$id}";
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
          }
          catch(\Exception $exception) {
              die($exception->getMessage());
          }
    }

    public function selectOne($table, $id=0) {
        if ($id>0){
          $sql = "SELECT * FROM {$table} WHERE id = {$id}";
        }else{
          $sql = "SELECT * FROM {$table} ORDER BY ID DESC LIMIT 1";
        }

        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS) [0];
    }

    public function selectParticipate($champ_id) {
        $sql = "select * from participate INNER JOIN team WHERE participate.id_team = team.id and id_champ = {$champ_id} ORDER BY participate.points DESC";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_CLASS);
    }

    public function updateParticipate($id_team, $points)
    {
      $sql = "UPDATE participate SET points = points + {$points} WHERE id_team = {$id_team}";
      try {
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
      }
      catch(\Exception $exception) {
          die($exception->getMessage());
      }      
    }

    public function updateChamp($parameters) {
        $name = ($parameters['name']);
        $premium = ($parameters['premium']);
        $ptw = ($parameters['ptw']);
        $champ_id = ($parameters['champ_id']);
        $description = ($parameters['description']);

        $sql = "UPDATE championship SET name='$name', premium='$premium', ptw='$ptw', description='$description' WHERE id = '$champ_id'";
        
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        }
        catch(\Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function createEmptyChamp()
    {
        $sql = "INSERT INTO championship (name, premium, ptw) VALUES ('', 0, 0)";
      try {
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
      }
      catch(\Exception $exception) {
          die($exception->getMessage());
      }   
    }


    public function selectAll($table) {
        $sql = "select * from {$table}";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_CLASS);
    }
    public function insert($table, $parameters) {
        $sql = sprintf('insert into %s (%s) values (%s)', $table, implode(', ', array_keys($parameters)), ':' . implode(', :', array_keys($parameters)));
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
        }
        catch(\Exception $e) {
            echo ($e->getMessage());
        }
    }
    public function delete($table) {
        $sql = 'delete from {$table}';
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        }
        catch(\Exception $e) {
            echo ($e->getMessage());
        }
    }
}
