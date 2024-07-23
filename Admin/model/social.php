<?php
include_once __DIR__. '../../vendor/db/db.php';

class Social{
    public function getSocials(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select * from social_media";
        $statement=$con->prepare($sql);
        if($statement->execute()){
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function updateSocial($fb,$tiktok,$insta,$phone)
    {
        $id=1;
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='update social_media set fb=:fb,tiktok=:tiktok,insta=:insta,phone=:phone where social_id=:id';
        $statement=$con->prepare($sql);
        $statement->bindParam(':fb',$fb);
        $statement->bindParam(':tiktok',$tiktok);
        $statement->bindParam(':insta',$insta);
        $statement->bindParam(':phone',$phone);
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