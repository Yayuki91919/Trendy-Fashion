<?php
include_once __DIR__. '../../vendor/db/db.php';

class Delivery{
    public function getDeliveryByInvoiceId($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="SELECT * FROM delivery WHERE invoice_id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function updateDelivery($id,$shipped_date,$delivered_date,$status)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = 'UPDATE delivery SET shipping_date = :ship, delivered_date = :deli, status = :status WHERE deli_id = :id';
        $statement = $con->prepare($sql);
        
        $statement->bindParam(':ship', $shipped_date);
        $statement->bindParam(':deli', $delivered_date);
        $statement->bindParam(':status', $status);
        $statement->bindParam(':id', $id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
   
    
}
?>