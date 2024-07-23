<?php

include_once __DIR__. '../../model/profile.php';

class ProfileController extends Profile{
        public function getProfile()
        {
            return $this->getProfiles();
        }
        public function editProfile($email,$password,$username,$image)
        {
            return $this->updateProfile($email,$password,$username,$image);
        }
}
?>