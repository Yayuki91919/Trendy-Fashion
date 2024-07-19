<?php

include_once __DIR__. '../../model/deli_info.php';

class DeliInfoController extends DeliInfo{
    
        public function getDeliInfoListById($id){
            return $this->getDeliInfoById($id);
        }
        public function createDeliinfo($name,$email,$phone,$location_id,$address){
            return $this->addDeliinfo($name,$email,$phone,$location_id,$address);
        }
}
?>