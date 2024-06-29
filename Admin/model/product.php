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
            p.date,
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
    
    // public function addNewProduct($filename, $name, $price, $cat_id, $sub_id, $type_id, $des){
    //     $con=Database::connect();
    //     $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    //     // 1. Insert into product table
    //     $sql = "INSERT INTO product (name, description,price,status,type_id,sub_id,state)
    //      VALUES (:name,:des,:price,'status',:type_id,:sub_id,'state')";
    //     $statement = $con->prepare($sql);
    //     $statement->bindParam(':name', $name);
    //     $statement->bindParam(':des', $des);
    //     $statement->bindParam(':price', $price);
    //     $statement->bindParam(':type', $type_id);
    //     $statement->bindParam(':sub_id', $sub_id);
    //     $statement->execute();
    //     $product_id = $con->lastInsertId(); // Get the ID of the last inserted product

    //     // 2. Insert into product_image table
    //     $sql = "INSERT INTO product_image (image_name, product_id) VALUES (:image, :product_id)";
    //     $statement = $con->prepare($sql);

    //     //multiple image
    //     foreach ($filename as $image) {
    //         $statement->bindParam(':image', $image);
    //         $statement->bindParam(':product_id', $product_id);
    //         $statement->execute();
    //     }
        

    //    // 3. Insert into product_detail table for each size and color
    //    $sql = "SELECT * FROM temp_product";
        
    //    foreach($statement->execute($sql) as $row)
    //    {
    //         $color_id = $row['color_id'];
    //         $size_id = $row['size_id'];
    //         $qty = $row['qty'];
    //         $sql = "INSERT INTO product_detail (product_id,color,size, qty) VALUES (:product_id, :color, :size, :qty)";
    //         $statement = $con->prepare($sql);
    //             $statement->bindParam(':color', $color_id);
    //             $statement->bindParam(':size', $size_id);
    //             $statement->bindParam(':qty', $qty);
    //             $statement->bindParam(':product_id', $product_id);
    //             $statement->execute();

    //    }
       
    //     if($statement->execute())
    //     {
    //         return true;
    //     }
    //     else
    //     {
    //         return false;
    //     }
    // }

    public function addNewProduct($filenames, $name, $price, $sub_id, $type_id, $des)
{

    // Connect to the database
    $con = Database::connect();
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $date = date('d-m-Y H:i')." hr";

        // 1. Insert into product table
        $sql = "INSERT INTO product (product_name, description, price, status, type_id, sub_id, state,date)
                VALUES (:name, :des, :price, 'status', :type_id, :sub_id, 'state',:date)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':des', $des);
        $statement->bindParam(':price', $price);
        $statement->bindParam(':type_id', $type_id);
        $statement->bindParam(':sub_id', $sub_id);
        $statement->bindParam(':date', $date);
        $statement->execute();

        $product_id = $con->lastInsertId(); // Get the ID of the last inserted product

        // 2. Insert into product_image table
        $sql = "INSERT INTO product_image (image_name, product_id) VALUES (:image, :product_id)";
        $statement = $con->prepare($sql);

        // Multiple images
        foreach ($filenames as $image) {
            $statement->bindParam(':image', $image);
            $statement->bindParam(':product_id', $product_id);

            $statement->execute();
        }

        // 3. Insert into product_detail table for each size and color
        $sql = "SELECT * FROM temp_product";
        $statement = $con->prepare($sql);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $color_id = $row['color_id'];
            $size_id = $row['size_id'];
            $qty = $row['qty'];
            $sql = "INSERT INTO product_detail (product_id, color, size, qty)
             VALUES (:product_id, :color, :size, :qty)";
            $detail_statement = $con->prepare($sql);
            $detail_statement->bindParam(':color', $color_id);
            $detail_statement->bindParam(':size', $size_id);
            $detail_statement->bindParam(':qty', $qty);
            $detail_statement->bindParam(':product_id', $product_id);
            $detail_statement->execute();
        }

        $sql = "Delete FROM temp_product";
        $statement = $con->prepare($sql);
        $statement->execute();

        return true;


}


    public function addSizeColorlist($color_id,$color,$size_id,$size,$qty)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO temp_product (color_id, color, size_id, size, qty)
        VALUES (:color_id, :color, :size_id, :size, :qty)";

        $statement = $con->prepare($sql);
        $statement->bindParam(':color_id', $color_id);
        $statement->bindParam(':color', $color);
        $statement->bindParam(':size_id', $size_id);
        $statement->bindParam(':size', $size);
        $statement->bindParam(':qty', $qty);

        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    public function getColorInfo($color_id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select color from product_color where color_id='$color_id'";
        $statement=$con->prepare($sql);
        if($statement->execute()){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function getSizeInfo($size_id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select size from product_size where size_id='$size_id'";
        $statement=$con->prepare($sql);
        if($statement->execute()){
            $result=$statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
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
    public function getColorList(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select * from product_color";
        $statement=$con->prepare($sql);
        if($statement->execute()){
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function getSizeList(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select * from product_size";
        $statement=$con->prepare($sql);
        if($statement->execute()){
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function getSizeColor(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select * from temp_product";
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

    public function deleteSizeColorInfo($id)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="delete from temp_product where id=:id";
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