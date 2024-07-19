<?php

include_once __DIR__. '../../model/shopinfo.php';

class ShopInfoController extends ShopInfo{
        public function getShopInfo(){
            return $this->getShopInfos();
        }
        public function getShopById($id){
            return $this->getShopInfoById($id);
        }
        public function addShopInfo($name,$phone,$viber,$address,$open,$close)
        {
            return $this->createShopInfo($name,$phone,$viber,$address,$open,$close);
        }
        public function editShopInfo($id,$name,$phone,$viber,$address,$open,$close)
        {
            return $this->updateShopInfo($id,$name,$phone,$viber,$address,$open,$close);
        }
        public function deleteShop($id)
        {
            return $this->deleteShopInfo($id);
        }
       


}
?>