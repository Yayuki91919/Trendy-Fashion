<?php
include_once __DIR__. '../../vendor/db/db.php';

class Banner{
    public function getBannerList(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select * from banner";
        $statement=$con->prepare($sql);
        if($statement->execute()){
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;

    }
    public function getBannerById($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select * from banner where banner_id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result ;
        }

    }
    
    public function createBanner($title,$image,$sub_id)
    {
                $con=Database::connect();
                $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql='insert into banner(title,image,sub_id) values (:title,:image,:sub_id)';
                $statement=$con->prepare($sql);
                $statement->bindParam(':title',$title);
                $statement->bindParam(':image',$image);
                $statement->bindParam(':sub_id',$sub_id);
                if($statement->execute())
                {
                    return true;
                }
                else{
                    return false;
                }
    }
    public function updateBanner($id, $title, $sub_id)
    {
    $con = Database::connect();
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'UPDATE banner SET title = :title, sub_id = :sub_id WHERE banner_id = :id';
    $statement = $con->prepare($sql);
    $statement->bindParam(':title', $title);
    $statement->bindParam(':sub_id', $sub_id);
    $statement->bindParam(':id', $id);
    return $statement->execute();
    }
    
    public function updateBannerImage($id,$image)
    {
    $con = Database::connect();
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'UPDATE banner SET image = :image WHERE banner_id = :id';
    $statement = $con->prepare($sql);
    $statement->bindParam(':image', $image);
    $statement->bindParam(':id', $id);
    return $statement->execute();
    }

    public function deleteBannerInfo($id)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='delete from banner where banner_id=:id';
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
}
?>