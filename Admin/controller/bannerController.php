<?php

include_once __DIR__. '../../model/banner.php';

class BannerController extends Banner{
        public function getBanners(){
            return $this->getBannerList();
        }
        public function getBanner($id){
            return $this->getBannerById($id);
        }
        public function editBanner($id,$title,$image,$sub_id)
        {
            return $this->updateBanner($id,$title,$image,$sub_id);
        }
        public function editBannerImage($id,$image)
        {
            return $this->updateBannerImage($id,$image);
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