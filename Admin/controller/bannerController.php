<?php

include_once __DIR__. '../../model/banner.php';

class BannerController extends Banner{
        public function getBanners(){
            return $this->getBannerList();
        }
        public function getBanner($id){
            return $this->getBannerById($id);
        }
        public function editBanner($id,$name,$email,$phone)
        {
            return $this->updateBanner($id,$name,$email,$phone);
        }
        public function addBanner($title,$image,$sub_id)
        {
            return $this->createBanner($title,$image,$sub_id);

        }
        public function deleteBanner($id)
        {
            return $this->deleteBannerInfo($id);
        }


}
?>