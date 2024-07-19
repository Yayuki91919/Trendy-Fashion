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
        $sql="SELECT p.*,(SELECT image_name 
             FROM product_image 
             WHERE product_id = p.product_id 
             ORDER BY RAND() 
             LIMIT 1) AS random_image FROM product as p WHERE product_id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result ;
        }

    }
    public function createOrder($d_id,$qty,$invoice_id,$cus_status,$cid)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="insert into place_order(product_detail_id,quantity,invoice_id,cus_status) 
        value (:d_id,:quantity, :invoice_id, :cus_status)";
        $statement=$con->prepare($sql);
        $statement->bindParam(':d_id',$d_id);
        $statement->bindParam(':quantity',$qty);
        $statement->bindParam(':invoice_id',$invoice_id);
        $statement->bindParam(':cus_status',$cus_status);
        if ($statement->execute()) {
        $sql = "Delete FROM cart where customer_id=:customer_id ";
        $statement = $con->prepare($sql);
        $statement->bindParam(':customer_id',$cid);
        $statement->execute();
            return true;
        } else {
            return false;
        }
    }
   
   
    
}
?>