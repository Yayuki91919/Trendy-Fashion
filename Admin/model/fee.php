<?php
include_once __DIR__. '../../vendor/db/db.php';

class Fee{
    public function getFeeListById($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="SELECT * FROM deli_fee WHERE fee_id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function getFeeListByLocationId($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="SELECT * FROM deli_fee WHERE location_id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function addNewFee($fee,$location_id)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="insert into deli_fee(fee,location_id) 
        value (:fee,:location_id)";
        $statement=$con->prepare($sql);
        $statement->bindParam(':fee',$fee);
        $statement->bindParam(':location_id',$location_id);
        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function updateFee($id,$fee)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = 'UPDATE deli_fee SET fee = :fee WHERE location_id = :id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':fee', $fee);
        $statement->bindParam(':id', $id);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteFeeInfo($id)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='delete from fee where location_id=:id';
        $statement=$con->prepare($sql);
        $statement->bindParam('id',$id);
        try{
            $statement->execute();
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
    }
    
    
}
?>