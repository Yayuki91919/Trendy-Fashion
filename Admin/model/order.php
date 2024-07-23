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
             LIMIT 1) AS random_image,o.*,c.color as pcolor,s.size as psize FROM product AS p
            JOIN product_detail AS d ON d.product_id=p.product_id
            JOIN place_order AS o ON o.product_detail_id=d.d_id
            JOIN product_color As c ON c.color_id=d.color
            JOIN product_size As s ON s.size_id=d.size
            WHERE d.d_id=:id";
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

        $sql_get_qty = 'SELECT qty FROM product_detail WHERE d_id = :d_id';
        $statement_get_qty = $con->prepare($sql_get_qty);
        $statement_get_qty->bindParam(':d_id', $d_id);
        $statement_get_qty->execute();
        $product_detail = $statement_get_qty->fetch(PDO::FETCH_ASSOC);

        $available_qty = $product_detail['qty'];
        $real_qty = $available_qty-$qty;
        
        $sql_update = 'UPDATE product_detail SET qty = :quantity WHERE d_id = :d_id';
        $statement_update = $con->prepare($sql_update);
        $statement_update->bindParam(':quantity', $real_qty, PDO::PARAM_INT);
        $statement_update->bindParam(':d_id', $d_id);
        $statement_update->execute();

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