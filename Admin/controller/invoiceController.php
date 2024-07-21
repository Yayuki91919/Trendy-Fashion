<?php

include_once __DIR__. '../../model/invoice.php';

class InvoiceController extends Invoice{
        public function getInvoices(){
            return $this->getInvoiceList();
        }
        public function getInvoice($id){
            return $this->getInvoiceById($id);
        }
        public function getInvoiceInfoByCustomerId($id){
            return $this->getInvoiceByCustomerId($id);
        }
        public function getLastInvoice(){
            return $this->getLastInvoiceNo();
        }
        public function createInvoice($invoice_no,$cid,$d_info_id,$fee_id,$total,$invoice_date){
            return $this->addInvoice($invoice_no,$cid,$d_info_id,$fee_id,$total,$invoice_date);
        }
        public function deleteOrder($invoice_id){
            return $this->deleteOrderInfo($invoice_id);
        }

}
?>