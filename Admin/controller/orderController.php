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

}
?>