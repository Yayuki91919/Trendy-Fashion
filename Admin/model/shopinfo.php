<?php
include_once __DIR__. '../../vendor/db/db.php';

class ShopInfo{
    public function getShopInfos(){
        $id=1;
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select * from shop_info where shop_id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result ;
        }

    }

    public function updateShopInfo($id,$phone,$email,$address,$map_link,$fb,$twt,$insta)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='update shop_info set phone=:phone,email=:email,address=:address,map_link=:map,fb_link=:fb,twitter_link=:twt,insta_link=:insta where shop_id=:id';
        $statement=$con->prepare($sql);
        $statement->bindParam(':phone',$phone);
        $statement->bindParam(':email',$email);
        $statement->bindParam(':address',$address);
        $statement->bindParam(':map',$map_link);
        $statement->bindParam(':fb',$fb);
        $statement->bindParam(':twt',$twt);
        $statement->bindParam(':insta',$insta);
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