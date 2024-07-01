<?php

include_once __DIR__. '../../model/adminlogin.php';

class AdminLoginController extends Admin{
        public function getAdmin(){
            return $this->getAdminInfo();
        }
        public function editAdmin($id,$info)
        {
            return $this->updateAdmin($id,$info);
        }
}
?>