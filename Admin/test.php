<?php

 include_once __DIR__. '../controller/deliveryController.php';
 $delivery_controller=new DeliveryController();
 $delivery=$delivery_controller->getDeliveryListByInvoiceId($id);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $id=$_POST['invoice_id'];
    $status=$_POST['status'];
    $date=$_POST['date'];
    $delivery_id=$_POST['delivery_id'];
    if($status=='processing'){
        $shipped_date='';
        $delivered_date='';
    }elseif($status=='shipped'){
        $shipped_date=$date;
        $delivered_date='';
    }elseif($status=='delivered'){
        $shipped_date='';
        $delivered_date=$date;
    }
        $result=$delivery_controller->editDelivery($id,$shipped_date,$delivered_date,$status);
        if($result)
        {
            $message=2;
            echo '<script> location.href="invoice_detail.php?invoice_id='.$id.'"</script>';
        }
}
?>
<form id="statusForm">
    <div class="form-group">
        <input type="hidden" name="invoice_id" value="<?php echo $id; ?>">
        <input type="hidden" name="delivery_id" value="<?php echo $delivery['deli_id']; ?>">
        <label class="mt-2">Delivery Status</label>
        <select name="status" class="form-control">
            <option value="processing">Processing</option>
            <option value="shipped">Shipped</option>
            <option value="delivered">Delivered</option>
        </select>
    </div>
    <div class="form-group">
        <label class="mt-2">Date At</label>
        <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="date" id="mdate">
    </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Change</button>
</form>