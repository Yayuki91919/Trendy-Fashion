<?php
include_once __DIR__ . '../../vendor/db/db.php';

class User
{

    public function registerUser($name, $email, $password, $phone)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "insert into customer_account(username,email,password,phone)
            value('$name','$email','$password','$phone')";
        $statement1 = $con->prepare($sql);
        if ($statement1->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkUser($email)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM customer_account WHERE email = '$email'";
        $statement=$con->prepare($sql);
        if($statement->execute())
        {
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;

    }

    public function login($e,$p){
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql="select * from customer_account where email=:email and password=:password";
        $statement=$con->prepare($sql);
        $statement->bindParam(':email',$e);
        $statement->bindParam(':password',$p);
        if($statement->execute())
        {
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result ;


    }

}
