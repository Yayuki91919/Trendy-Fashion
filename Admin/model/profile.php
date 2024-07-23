<?php
include_once __DIR__. '../../vendor/db/db.php';

class Profile{
    public function getProfiles(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select * from admin_login where id='1'";
        $statement=$con->prepare($sql);
        if($statement->execute()){
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function updateProfile($email,$password,$username,$image)
    {
        $id=1;
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='update admin_login set email=:email,password=:password,username=:username,image=:image where id=:id';
        $statement=$con->prepare($sql);
        $statement->bindParam(':email',$email);
        $statement->bindParam(':password',$password);
        $statement->bindParam(':username',$username);
        $statement->bindParam(':image',$image);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            return true;
        }
        else{
            return false;
        }
    }
   

}
?>