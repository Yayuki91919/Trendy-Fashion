<?php

include_once __DIR__. '../../model/deli_info.php';

class DeliInfoController extends DeliInfo{
    
        public function getDeliInfoListById($id){
            return $this->getDeliInfoById($id);
        }
}
?>