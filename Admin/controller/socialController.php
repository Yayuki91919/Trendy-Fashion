<?php

include_once __DIR__. '../../model/social.php';

class SocialController extends Social{
        public function getSocial()
        {
            return $this->getSocials();
        }
        public function editSocial($fb,$tiktok,$insta,$phone)
        {
            return $this->updateSocial($fb,$tiktok,$insta,$phone);
        }
}
?>