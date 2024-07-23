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

    public function deleteOrderInfo($invoice_id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $con->beginTransaction();
        
        try {
            // Get delivery info ID
            $sql_get_d_id = 'SELECT deli_info_id FROM invoice WHERE invoice_id = :id';
            $statement_get_d_id = $con->prepare($sql_get_d_id);
            $statement_get_d_id->bindParam(':id', $invoice_id, PDO::PARAM_INT);
            $statement_get_d_id->execute();
            $d_info = $statement_get_d_id->fetch(PDO::FETCH_ASSOC);
            $d_info_id = $d_info['deli_info_id'];
            
            // Get orders related to the invoice
            $sql_get_order = 'SELECT * FROM place_order WHERE invoice_id = :id';
            $statement_order = $con->prepare($sql_get_order);
            $statement_order->bindParam(':id', $invoice_id, PDO::PARAM_INT);
            $statement_order->execute();
            $orders = $statement_order->fetchAll(PDO::FETCH_ASSOC);
    
            foreach ($orders as $order) {
                $p_d = $order['product_detail_id'];
                $o_q = $order['quantity'];
                
                // Get current product quantity
                $sql_get_qty = 'SELECT qty FROM product_detail WHERE d_id = :id';
                $statement_qty = $con->prepare($sql_get_qty);
                $statement_qty->bindParam(':id', $p_d, PDO::PARAM_INT);
                $statement_qty->execute();
                $p_qty = $statement_qty->fetch(PDO::FETCH_ASSOC);
                $p_q = $p_qty['qty'];
                $update_qty = $p_q + $o_q;
    
                // Update product quantity
                $sql_update = 'UPDATE product_detail SET qty = :quantity WHERE d_id = :d_id';
                $statement_update = $con->prepare($sql_update);
                $statement_update->bindParam(':quantity', $update_qty, PDO::PARAM_INT);
                $statement_update->bindParam(':d_id', $p_d, PDO::PARAM_INT);
                $statement_update->execute();
            }
    
            // Delete the invoice
            $sql_delete_invoice = 'DELETE FROM invoice WHERE invoice_id = :id';
            $statement_delete_invoice = $con->prepare($sql_delete_invoice);
            $statement_delete_invoice->bindParam(':id', $invoice_id, PDO::PARAM_INT);
            $statement_delete_invoice->execute();
    
            // Delete the delivery info
            $sql_delete_deli_info = 'DELETE FROM deli_info WHERE deli_info_id = :id';
            $statement_delete_deli_info = $con->prepare($sql_delete_deli_info);
            $statement_delete_deli_info->bindParam(':id', $d_info_id, PDO::PARAM_INT);
            $statement_delete_deli_info->execute();
    
            $con->commit();
            return true;
        } catch (Exception $e) {
            $con->rollBack();
            return false;
        }
    }
    
}
?>