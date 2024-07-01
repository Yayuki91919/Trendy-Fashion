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

}
?>