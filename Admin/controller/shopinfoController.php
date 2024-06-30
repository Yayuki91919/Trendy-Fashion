<?php

include_once __DIR__. '../../model/shopinfo.php';

class ShopInfoController extends ShopInfo{
        public function getShopInfo(){
            return $this->getShopInfos();
        }
        public function editShopInfo($id,$phone,$email,$address,$map_link,$fb,$twt,$insta)
        {
            return $this->updateShopInfo($id,$phone,$email,$address,$map_link,$fb,$twt,$insta);
        }


}
?>