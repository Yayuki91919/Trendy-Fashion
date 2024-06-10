<?php
include_once __DIR__. '/../vendor/db/db.php';

class Product{
    public function getProductList(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select product.id as id,product.name as name,product.image as image
        ,product.price as price,product.description as desp,category.name as 
        catname from product join category on product.cat_id=category.id";
        // $sql='SELECT product.* FROM product JOIN category WHERE cat_id=category.id';
        $statement=$con->prepare($sql);
        if($statement->execute()){
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;

    }
    public function addNewProduct($filename,$name,$price,$desp,$category){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="insert into product(image,name,price,description,cat_id) 
        value (:image,:name,:price,:desp,:category)";
        $statement=$con->prepare($sql);
        $statement->bindParam(':image',$filename);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':price',$price);
        $statement->bindParam(':desp',$desp);
        $statement->bindParam(':category',$category);
        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function getCategoryList(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select * from category";
        $statement=$con->prepare($sql);
        if($statement->execute()){
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function getProductInfo($id)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select * from product where id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result ;
        }
    }
    public function updateProduct($id,$filename,$name,$price,$desp,$category)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="update product
        set image=:image,name=:name,price=:price,description=:desp,cat_id=:category where id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        $statement->bindParam(':image',$filename);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':price',$price);
        $statement->bindParam(':desp',$desp);
        $statement->bindParam(':category',$category);
        
        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function deleteProductInfo($id)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="delete from product where id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        try
        {
            $statement->execute();
            return true;
        }
        catch(PDOException $e)
        {
            return false;
        }
    }


}

?>