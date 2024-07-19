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
    public function getLastInvoiceNo()
{
    $con = Database::connect();
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Use MAX() to get the highest invoice number
    $sql = "SELECT MAX(invoice_no) as last_invoice_no FROM invoice";
    $statement = $con->prepare($sql);

    if ($statement->execute()) {
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['last_invoice_no'] ?? null; // Return null if no result
    } else {
        return false; // Handle query execution failure
    }
}
    public function getInvoiceById($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="SELECT * FROM invoice WHERE invoice_id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function getInvoiceByCustomerId($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="SELECT * FROM invoice WHERE customer_id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute()){
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function addInvoice($invoice_no,$cid,$d_info_id,$fee_id,$total,$invoice_date)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="insert into invoice(invoice_no,customer_id,deli_info_id,fee_id,total,invoice_date) 
        value (:invoice,:customer_id, :deli_info_id, :fee_id,:total,:invoice_date)";
        $statement=$con->prepare($sql);
        $statement->bindParam(':invoice',$invoice_no);
        $statement->bindParam(':customer_id',$cid);
        $statement->bindParam(':deli_info_id',$d_info_id);
        $statement->bindParam(':fee_id',$fee_id);
        $statement->bindParam(':total',$total);
        $statement->bindParam(':invoice_date',$invoice_date);
        if ($statement->execute()) {
            // Return the ID of the last inserted row
            return $con->lastInsertId();
        } else {
            return false;
        }
    }
    
}
?>