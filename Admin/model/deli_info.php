<?php
include_once __DIR__. '../../vendor/db/db.php';

class DeliInfo{
    public function getDeliInfoById($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="SELECT * FROM deli_info WHERE deli_info_id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

    }
    public function addDeliinfo($name,$email,$phone,$location_id,$address)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="insert into deli_info(name,email,phone,location_id,address_details) 
        value (:name,:email, :phone, :location_id,:address)";
        $statement=$con->prepare($sql);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':email',$email);
        $statement->bindParam(':phone',$phone);
        $statement->bindParam(':location_id',$location_id);
        $statement->bindParam(':address',$address);
        if ($statement->execute()) {
            // Return the ID of the last inserted row
            return $con->lastInsertId();
        } else {
            return false;
        }
    }
   
   
    
}
?>