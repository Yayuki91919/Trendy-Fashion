<?php

include_once __DIR__. '../../model/fee.php';

class FeeController extends Fee{
        public function getFeesById($id){
            return $this->getFeeListById($id);
        }
        public function getFeeInfoByLocationId($id){
            return $this->getFeeListByLocationId($id);
        }
        public function createNewFee($lid,$fee_value){
            return $this->addNewFee($lid,$fee_value);
        }
        public function editFee($id,$fee)
        {
            return $this->updateFee($id,$fee);
        }
        public function deleteFee($id)
        {
            return $this->deleteFeeInfo($id);
        }
        


}
?>