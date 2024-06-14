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
   
   
    
}
?>