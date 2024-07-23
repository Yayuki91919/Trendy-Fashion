<?php

include_once __DIR__. '../../model/order.php';

class OrderController extends Order{
        public function getInvoices(){
            return $this->getInvoiceList();
        }
        public function getOrderListByInvoice($id){
            return $this->getOrderByInvoice($id);
        }
        public function getProductListByInvoice($id){
            return $this->getProductByInvoice($id);
        }
        public function addOrder($d_id,$qty,$invoice_id,$cus_status,$cid){
            return $this->createOrder($d_id,$qty,$invoice_id,$cus_status,$cid);
        }

}
?>