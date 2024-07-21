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
    public function updateDelivery($id, $shipped_date, $delivered_date, $status)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = 'UPDATE delivery 
                SET shipping_date = :ship, 
                    delivered_date = :deli, 
                    status = :status 
                WHERE invoice_id = :id';
        
        $statement = $con->prepare($sql);
        
        // Use NULL if dates are empty
        $shipped_date = !empty($shipped_date) ? $shipped_date : null;
        $delivered_date = !empty($delivered_date) ? $delivered_date : null;
        
        $statement->bindParam(':ship', $shipped_date);
        $statement->bindParam(':deli', $delivered_date);
        $statement->bindParam(':status', $status);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
    
        return $statement->execute();
    }
    
    public function addDelivery($invoice_id)
    {
        $ship_date=null;
        $deli_date=null;
        $status="processing";
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="insert into delivery(invoice_id,shipping_date,delivered_date,status) 
        value (:invoice_id,:shipping_date,:delivered_date,:status)";
        $statement=$con->prepare($sql);
        $statement->bindParam(':invoice_id',$invoice_id);
        $statement->bindParam(':shipping_date',$ship_date);
        $statement->bindParam(':delivered_date',$deli_date);
        $statement->bindParam(':status',$status);
        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
   
    
}
?>