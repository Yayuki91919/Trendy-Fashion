<?php
include_once __DIR__. '../../vendor/db/db.php';

class Order{
    public function getOrderByInvoice($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="SELECT 
            *
            FROM 
                place_order 
            WHERE 
                invoice_id = :id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

    }
    public function getProductByInvoice($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="SELECT * FROM product WHERE product_id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result ;
        }

    }
   
   
    
}
?>