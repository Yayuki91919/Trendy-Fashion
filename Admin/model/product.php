<?php
include_once __DIR__ . '/../vendor/db/db.php';

class Product
{
    public function getProductList()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "

        SELECT 
            p.product_id,
            p.product_name,
            p.description,
            p.price,
            p.sub_id,
            p.type_id,
            p.status,
            p.state,
            p.date,
            t.name AS type_name,
            t.type_id,
            sc.category_id,
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
            type AS t ON t.type_id = p.type_id
        JOIN
            sub_category AS sc ON p.sub_id = sc.sub_id
        JOIN 
            category AS c ON sc.category_id = c.category_id
        ORDER BY p.product_id DESC

                ";


        $statement = $con->prepare($sql);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }


    public function addNewProduct($filenames, $name, $price, $sub_id, $type_id, $des)
    {

        // Connect to the database
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $date = date('d-m-Y H:i');

        // 1. Insert into product table
        $sql = "INSERT INTO product (product_name, description, price, status, type_id, sub_id, state,date)
                VALUES (:name, :des, :price, 'Private', :type_id, :sub_id, 'None',:date)";
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

    public function addNewMoreImage($filenames, $product_id)
    {   
        // Connect to the database
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 2. Insert into product_image table
        $sql = "INSERT INTO product_image (image_name, product_id) VALUES (:image, :product_id)";
        $statement = $con->prepare($sql);

        // Multiple images
        foreach ($filenames as $image) {
            $statement->bindParam(':image', $image);
            $statement->bindParam(':product_id', $product_id);
    
            // Check execution for each image
            if (!$statement->execute()) {
                return false;
            }
        }
    
        return true;


    }


    public function addSizeColorlist($color_id, $color, $size_id, $size, $qty)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO temp_product (color_id, color, size_id, size, qty)
        VALUES (:color_id, :color, :size_id, :size, :qty)";

        $statement = $con->prepare($sql);
        $statement->bindParam(':color_id', $color_id);
        $statement->bindParam(':color', $color);
        $statement->bindParam(':size_id', $size_id);
        $statement->bindParam(':size', $size);
        $statement->bindParam(':qty', $qty);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function addMoreSizeColorlist($size_id, $color_id, $qty, $id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO product_detail (color, size, qty,product_id)
        VALUES ( :color, :size, :qty, :id)";

        $statement = $con->prepare($sql);
        $statement->bindParam(':color', $color_id);
        $statement->bindParam(':size', $size_id);
        $statement->bindParam(':qty', $qty);
        $statement->bindParam(':id', $id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getColorInfo($color_id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select color from product_color where color_id='$color_id'";
        $statement = $con->prepare($sql);
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }


    public function getSizeInfo($size_id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select size from product_size where size_id='$size_id'";
        $statement = $con->prepare($sql);
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function getCategoryList()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select * from category";
        $statement = $con->prepare($sql);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function getColorList()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select * from product_color";
        $statement = $con->prepare($sql);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function getSizeList()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select * from product_size";
        $statement = $con->prepare($sql);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function getSizeColor()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select * from temp_product";
        $statement = $con->prepare($sql);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function getSizeColorInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
        SELECT 
            pd.d_id,
            pd.qty,
            pc.color,
            pz.size
        FROM 
            product_detail AS pd
        JOIN 
            product_color AS pc ON pd.color = pc.color_id
        JOIN 
            product_size AS pz ON pd.size = pz.size_id
        WHERE 
            pd.product_id = :id
    ";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function getImageList($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select * from product_image where product_id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return []; // Return an empty array if execution fails
        }
    }

    public function getProductInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
        
        SELECT 
            p.product_id,
            p.product_name,
            p.description,
            p.price,
            p.status,
            p.state,
            p.date,
            t.name AS type,
            t.type_id,
            sc.sub_id,
            sc.category_id,
            sc.brand_name,
            c.category_name,
            sc.brand_name,
            c.category_name
        FROM 
            product AS p
        JOIN
            type AS t ON t.type_id = p.type_id
        JOIN 
            sub_category AS sc ON p.sub_id = sc.sub_id
        JOIN 
            category AS c ON sc.category_id = c.category_id

        WHERE p.product_id = :id
                ";

        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function deleteSizeColorInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "delete from product_detail where product_id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function updateProduct($id,$product_name,$sub_id,$type_id,$price,$des,$state)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "update product set product_name=:product_name,
        price=:price,description=:des,sub_id=:sub_id,type_id=:type_id,state=:state where product_id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':product_name', $product_name);
        $statement->bindParam(':price', $price);
        $statement->bindParam(':des', $des);
        $statement->bindParam(':sub_id', $sub_id);
        $statement->bindParam(':type_id', $type_id);
        $statement->bindParam(':state', $state);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteProductInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "delete from product where product_id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteProductDetailInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "delete from product_detail where d_id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function deleteImageInfo($delete_image)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "delete from product_image where image_id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $delete_image);
        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function deleteTempInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "delete from temp_product where id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function getProductsInfoByType($typeId)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='select * from product where type_id=:id';
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$typeId);

        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }  
    }
    public function getProductsInfoBySubCategory($subCategoryId)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='select * from product where sub_id=:id';
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$subCategoryId);

        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }  
    }
    
}
