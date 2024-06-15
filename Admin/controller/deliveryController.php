<?php

include_once __DIR__. '../../model/delivery.php';

class DeliveryController extends Delivery{
    
        public function getDeliveryListByInvoiceId($id){
            return $this->getDeliveryByInvoiceId($id);
        }
        public function editDelivery($id,$shipped_date,$delivered_date,$status)
        {
            return $this->updateDelivery($id,$shipped_date,$delivered_date,$status);
        }
}
?>