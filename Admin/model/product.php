<?php
include_once __DIR__. '/../vendor/db/db.php';

class Product{
    public function getProductList(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        // $sql = "
        //     SELECT 
        //         c.category_name,
        //         sc.brand_name,
        //         p.name AS product_name,
        //         pd.size,
        //         SUM(pd.qty) AS total_qty,
        //         pd.color
        //     FROM 
        //         product AS p
        //     JOIN 
        //         product_detail AS pd ON p.product_id = pd.product_id
        //     JOIN 
        //         sub_category AS sc ON p.sub_id = sc.sub_id
        //     JOIN 
        //         category AS c ON sc.category_id = c.category_id
        //     GROUP BY 
        //         p.product_id, pd.size, pd.color
        // ";
        
        $sql = "
                    SELECT 
                        p.*,
                        sc.*
                    FROM 
                        product AS p
                    JOIN 
                        sub_category AS sc ON p.sub_id = sc.sub_id
                        
                ";
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