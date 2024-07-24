<?php
class Database
{
    private $conn;
    
    public function __construct()
    {
        $this->Connection();
    }
    public function Connection()
    {
        try {
            $host = $_ENV['DB_HOST'];
            $dbName = $_ENV['DB_NAME'];
            $user = $_ENV['DB_USER'];
            $pass = $_ENV['DB_PASS'];
            $this->conn = new PDO("mysql:host=$host;dbname=$dbName", $user, $pass);
            // $this->conn = new PDO('mysql:host=localhost; dbname=portfolio', 'root', '');
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
        }
    }
    public function Insert($tableName, $data = [])
    {
        try {
            $columns = implode(',', array_keys($data));
            $questionMark = "";
            $increment = 1;
            for ($x = 0; $x < count($data); $x++) {
                $questionMark .= "?";
                if ($increment < count($data)) {
                    $questionMark .= ",";
                }
                $increment++;
            }
            $sql = "INSERT INTO $tableName($columns)VALUES($questionMark)";
            $prepareStatement = $this->conn->prepare($sql);
            if ($prepareStatement) {
                $prepareStatement->execute(array_values($data));
                return $this->conn->lastInsertId();
            }
        } catch (Exception $e) {
            echo "Error:" . $e->getMessage();
        }
    }


    public function Update($tableName, $data = [], $criteria = "id", $id = "")
    {
      
        try {
            $questionMark = "";
            $increment = 1;
            foreach ($data as $key => $value) {
                $questionMark .= $key . "=?";
                if ($increment < count($data)) {
                    $questionMark .= ",";
                }
                $increment++;
            }
            if (empty($criteria)) {
                $criteria = "id";
            }
            $sql = "UPDATE $tableName SET $questionMark WHERE $criteria=?";
            $mergeValue = array_merge(array_values($data), [$id]);
            $prepareStatement = $this->conn->prepare($sql);
            if ($prepareStatement) {
                $prepareStatement->execute($mergeValue);
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "Error:" . $e->getMessage();
        }
    }

    public function Delete($tableName,$criteria="",$bindValue=""){
        try{
            if(empty($criteria)){
                $criteria="id";
            }
            $sql="DELETE FROM $tableName WHERE $criteria=?";
            $prepareStatement=$this->conn->prepare($sql);
            if($prepareStatement){
                $prepareStatement->execute([$bindValue]);
                return true;
            }else{
                return false;
            }
        }catch(Exception $e){
            echo "Error:".$e->getMessage();
        }
    
    }


    public function All($tableName){
        try{
            $sql="SELECT * FROM $tableName";
            $prepareStatement=$this->conn->prepare($sql);
            if($prepareStatement){
                $prepareStatement->execute();
                return $prepareStatement->fetchAll(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }catch(Exception $e){
            echo "Error:".$e->getMessage();
        }

    }


    public function GetByCriteria($tableName,$criteria="*",$bindValue=""){
        try{
            if(empty($criteria)){
                $criteria="*";
            }
            $sql="SELECT $criteria FROM $tableName WHERE $criteria=?";
            $prepareStatement=$this->conn->prepare($sql);
            if($prepareStatement){
                $prepareStatement->execute([$bindValue]);
                return $prepareStatement->fetch(PDO::FETCH_OBJ);
            }else{
                return false;
            }
        }catch(Exception $e){
            echo "Error:".$e->getMessage();
        }
    }

    public function  customQuery($query)
    {
        try {
            $prepareStatement = $this->conn->prepare($query);
            if ($prepareStatement) {
                $prepareStatement->execute();
                return $prepareStatement->fetchAll(PDO::FETCH_OBJ);
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "Error:" . $e->getMessage();
        }
    }
}