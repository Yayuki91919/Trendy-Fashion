<?php

include_once __DIR__. '../../model/fee.php';

class FeeController extends Fee{
        public function getFeesById($id){
            return $this->getFeeListById($id);
        }
        
        


}
?>