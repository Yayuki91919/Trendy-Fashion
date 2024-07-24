<?php
include_once __DIR__. '../../vendor/db/db.php';

class ShopInfo{
    public function getShopInfos(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select * from shop_info";
        $statement=$con->prepare($sql);
        if($statement->execute()){
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function getShopInfoById($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select * from shop_info where shop_id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function createShopInfo($name,$phone,$viber,$address,$open,$close)
    {
                $con=Database::connect();
                $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql='insert into shop_info(name,phone,viber,address,open_time,close_time) values (:name,:phone,:viber,:address,:open,:close)';
                $statement=$con->prepare($sql);
                $statement->bindParam(':name',$name);
                $statement->bindParam(':phone',$phone);
                $statement->bindParam(':viber',$viber);
                $statement->bindParam(':address',$address);
                $statement->bindParam(':open',$open);
                $statement->bindParam(':close',$close);
                if($statement->execute())
                {
                    return true;
                }
                else{
                    return false;
                }
    }

    public function updateShopInfo($id,$name,$phone,$viber,$address,$open,$close)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='update shop_info set name=:name,phone=:phone,viber=:viber,address=:address,open_time=:open,close_time=:close where shop_id=:id';
        $statement=$con->prepare($sql);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':phone',$phone);
        $statement->bindParam(':viber',$viber);
        $statement->bindParam(':address',$address);
        $statement->bindParam(':open',$open);
        $statement->bindParam(':close',$close);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            return true;
        }
        else{
            return false;
        }
    }
    public function deleteShopInfo($id)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='delete from shop_info where shop_id=:id';
        $statement=$con->prepare($sql);
        $statement->bindParam('id',$id);
        try{
            $statement->execute();
            return true;
        }
        catch(Exception $e)
        {
            return false;
        }
    }
    
    public function getShopCount(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="SELECT COUNT(*) AS row_count FROM shop_info";
        $statement=$con->prepare($sql);
        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result['row_count'];
        }
    }
    
}
?>