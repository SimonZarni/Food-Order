<?php
include_once __DIR__ . '/../include/dbconfig.php';
class Payment{
    private $con,$statement;
    public function getPayments(){
        $this->con=Database::connect();
        $sql="select * from payment";
        $this->statement=$this->con->prepare($sql);
        if($this->statement->execute()){
            $payments=$this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $payments;
        };
    }

    public function getPayment($id){
        $this->con=Database::connect();
        $sql="select * from payment where id=:id;";
        $this->statement=$this->con->prepare($sql);
        $this->statement->bindParam(':id', $id);
        if($this->statement->execute()){
            $payment=$this->statement->fetchAll(PDO::FETCH_ASSOC);
            return $payment;
        };
    }

    public function addPayments($method){
        $this->con=Database::connect();
        $sql="INSERT INTO payment(method) VALUES 
        (:payment)"; //string
        $this->statement=$this->con->prepare($sql); //prepare statement
        $this->statement->bindParam(':payment',$method);
        return $this->statement->execute();
    }

    public function updatePayment($id, $method){
        $this->con=Database::connect();
        $sql="update payment set method=:method where id=:id"; //string
        $this->statement=$this->con->prepare($sql); //prepare statement
        $this->statement->bindParam(":id",$id);
        $this->statement->bindParam(":method",$method);
        return $this->statement->execute();
    }

    public function deletePayment($id){
        $status="deleted";
        $this->con=Database::connect();
        $sql="update payment set deleted_at=:status where id=:id"; //string
        $this->statement=$this->con->prepare($sql); //prepare statement
        $this->statement->bindParam(":id",$id);
        $this->statement->bindParam(":status",$status);
        return $this->statement->execute(); 
    }
}
?>