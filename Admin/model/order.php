<?php
include_once __DIR__. '../../vendor/db/db.php';

class Order{
    public function getOrderByInvoice($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="SELECT 
            o.*, 
            i.*
            FROM 
                place_order o
            JOIN 
                invoice i ON o.invoice_id = i.invoice_id
            WHERE 
                i.invoice_id = :id";
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