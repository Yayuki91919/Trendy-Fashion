<?php
include_once __DIR__. '/../model/user.php';

class UsersController extends Users 
{
    
    public function createUser($name, $email, $password, $phone)
    {
        return $this->registerUser($name, $email, $password, $phone);
    }
    public function check_user($email)
    {
        return $this->checkUser($email);
    }
    public function userLogin($e,$p){
        return $this->login($e,$p);
    }
}
?>
