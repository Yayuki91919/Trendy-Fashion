<?php
include_once __DIR__. '/../vendor/db/db.php';

class Product{
    public function getProductList(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);        
        $sql = "

        SELECT 
            p.product_id,
            p.product_name,
            p.description,
            p.price,
            p.status,
            p.state,
            sc.brand_name,
            c.category_name,
            (SELECT image_name 
             FROM product_image 
             WHERE product_id = p.product_id 
             ORDER BY RAND() 
             LIMIT 1) AS random_image
        FROM 
            product AS p
        JOIN 
            sub_category AS sc ON p.sub_id = sc.sub_id
        JOIN 
            category AS c ON sc.category_id = c.category_id

                ";
        

        $statement=$con->prepare($sql);
        if($statement->execute()){
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;

    }
    public function addNewProduct($name,$price, $cat_id, $sub_id, $desp,$img, $sizes_colors){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

 // 1. Insert into product table
        $sql = "INSERT INTO product (name, price, description, cat_id,sub_id) VALUES (:name, :price, :desp, :category,:sub_id)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':desp', $desp);
        $statement->bindParam(':price', $price);
        $statement->bindParam(':category', $cat_id);
        $statement->bindParam(':sub_id', $sub_id);
        $statement->execute();
        $product_id = $con->lastInsertId(); // Get the ID of the last inserted product

        // 2. Insert into product_image table
        $sql = "INSERT INTO product_image (image_name, product_id) VALUES (:image, :product_id)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':image', $img);
        $statement->bindParam(':product_id', $product_id);
        $statement->execute();

        // 3. Insert into product_detail table for each size and color
        $sql = "INSERT INTO product_detail (product_id, color, size, qty) VALUES (:product_id, :color, :size, :qty)";
        $statement = $con->prepare($sql);
        
        foreach ($sizes_colors as $size_color) {
            $size = $size_color['size'];
            foreach ($size_color['colors'] as $color) {
                $colorName = $color['name'];
                $quantity = $color['quantity'];
                $statement->bindParam(':product_id', $product_id);
                $statement->bindParam(':color', $colorName);
                $statement->bindParam(':size', $size);
                $statement->bindParam(':qty', $quantity);
                $statement->execute();
            }
        }

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