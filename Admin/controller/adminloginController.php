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
        public function getAdminEmail($email)
        {
            return $this->CheckAdminEmail($email);

        }
        public function UpdateAdminResetToken($email, $token)
        {
            return $this->UpdateResetToken($email, $token);
        }
        public function resetAdminPassword($token, $password)
        {
            return $this->ResetPassword($token, $password);

        }
}
?>