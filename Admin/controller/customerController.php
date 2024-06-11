<?php

include_once __DIR__. '../../model/customer.php';

class CustomerController extends Customer{
        public function getCustomers(){
            return $this->getCustomerList();
        }

        public function addCategory($name)
        {
            return $this->createCategory($name);

        }

        public function getCategory($id)
        {
            return $this->getCategoryInfo($id);
        }

        public function editCategory($id,$name)
        {
            return $this->updateCategory($id,$name);
        }

        public function deleteCategory($id)
        {
            return $this->deleteCategoryInfo($id);
        }


}
?>