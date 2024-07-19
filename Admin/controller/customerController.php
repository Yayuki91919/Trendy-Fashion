<?php

include_once __DIR__. '../../model/customer.php';

class CustomerController extends Customer{
        public function getCustomers(){
            return $this->getCustomerList();
        }
        public function getCustomer($id){
            return $this->getCustomerById($id);
        }
        public function editCustomer($id,$name,$email,$phone,$password)
        {
            return $this->updateCustomer($id,$name,$email,$phone,$password);
        }
        public function addCustomer($name)
        {
            return $this->createCustomer($name);
        }
        public function deleteCustomer($id)
        {
            return $this->deleteCustomerInfo($id);
        }


}
?>