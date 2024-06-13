<?php

include_once __DIR__. '../../model/invoice.php';

class InvoiceController extends Invoice{
        public function getInvoices(){
            return $this->getInvoiceList();
        }
        public function getInvoice($id){
            return $this->getInvoiceById($id);
        }
        


}
?>