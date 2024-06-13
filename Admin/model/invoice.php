<?php
include_once __DIR__. '../../vendor/db/db.php';

class Invoice{
    public function getInvoiceList(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="SELECT 
            i.*, 
            c.*, 
            f.*
        FROM 
            invoice i
        JOIN 
            customer_account c ON i.customer_id = c.customer_id
        JOIN 
            deli_fee f ON i.fee_id = f.fee_id";
        $statement=$con->prepare($sql);
        if($statement->execute()){
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;

    }
    public function getInvoiceById($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="SELECT 
            i.*, 
            c.*, 
            d.*
        FROM 
            invoice i
        JOIN 
            customer_account c ON i.customer_id = c.customer_id
        JOIN 
            deli_info d ON i.deli_info_id = d.deli_info_id
        WHERE 
            i.invoice_id =:id";
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