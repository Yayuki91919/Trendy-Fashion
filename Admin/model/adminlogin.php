<?php
include_once __DIR__. '../../vendor/db/db.php';

class Admin{
    public function getAdminInfo(){
        $id=1;
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select * from admin_login where id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result ;
        }

    }

    public function updateCollaboration($id,$info)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='update admin_login set info=:info where col_id=:id';
        $statement=$con->prepare($sql);
        $statement->bindParam(':info',$info);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            return true;
        }
        else{
            return false;
        }
    }

    public function updateAdmin($id,$info)
    {

    }
    public function CheckAdminEmail($email)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select * from admin_login where email=:email";
        $statement=$con->prepare($sql);
        $statement->bindParam(':email',$email);
        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result ;
        }
    }

    public function UpdateResetToken($email, $token) {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE admin_login SET reset_token = :token, token_expiry = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = :email";
        $statement = $con->prepare($sql);
        $statement->bindParam(':token', $token);
        $statement->bindParam(':email', $email);
        return $statement->execute();
    }


    public function ResetPassword($token, $newPassword) {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Validate token
        $sql = "SELECT * FROM admin_login WHERE reset_token = :token AND token_expiry > NOW()";
        $statement = $con->prepare($sql);
        $statement->bindParam(':token', $token);
        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Update the password
            // $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            
            $sql = "UPDATE admin_login SET password = :password, reset_token = NULL, token_expiry = NULL WHERE reset_token = :token";
            $statement = $con->prepare($sql);
            $statement->bindParam(':password', $newPassword);
            // $statement->bindParam(':password', $hashedPassword);
            $statement->bindParam(':token', $token);
            return $statement->execute();
        } else {
            return false;
        }
    }
}


?>