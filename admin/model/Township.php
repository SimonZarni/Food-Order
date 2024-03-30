<?php
include_once __DIR__ . '/../include/dbconfig.php';
class township{
    private $con,$statement;
    public function getTownships(){
        $this->con=Database::connect();
        $sql="select * from township";
        $this->statement=$this->con->prepare($sql);
        if($this->statement->execute()){
            $townships=$this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $townships;
        };
    }

    public function getTownship($id){
        $this->con=Database::connect();
        $sql="select * from township where id=:id;";
        $this->statement=$this->con->prepare($sql);
        $this->statement->bindParam(':id', $id);
        if($this->statement->execute()){
            $township=$this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $township;
        };
    }

    public function addTownship($township, $fee){
        $this->con=Database::connect();
        $sql="INSERT INTO township(name, fee) VALUES 
        (:name, :fee)"; //string
        $this->statement=$this->con->prepare($sql); //prepare statement
        $this->statement->bindParam(':name',$township);
        $this->statement->bindParam(':fee',$fee);
        return $this->statement->execute();
    }

    public function updateTownship($id, $township, $fee){
        $this->con=Database::connect();
        $sql="update township set name=:name,fee=:fee where id=:id"; //string
        $this->statement=$this->con->prepare($sql); //prepare statement
        $this->statement->bindParam(":id",$id);
        $this->statement->bindParam(":name",$township);
        $this->statement->bindParam(":fee",$fee);
        return $this->statement->execute();
    }

    public function deleteTownship($id){
        $status="deleted";
        $this->con=Database::connect();
        $sql="update township set deleted_at=:status where id=:id"; //string
        $this->statement=$this->con->prepare($sql); //prepare statement
        $this->statement->bindParam(":id",$id);
        $this->statement->bindParam(":status",$status);
        return $this->statement->execute(); 
    }
}
?>