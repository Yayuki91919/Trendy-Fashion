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
    public function getPublicProductList()
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
        WHERE 
            p.status=1
        ORDER BY p.product_id DESC
    ";



        $statement = $con->prepare($sql);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function getProductColorList()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * 
                FROM product_color
                ORDER BY color_id DESC ";

        $statement = $con->prepare($sql);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function getProductSizeList()
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * 
                FROM product_size
                ORDER BY size_id DESC ";
        $statement = $con->prepare($sql);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function createProductSize($size)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'insert into product_size(size) values (:size)';
        $statement = $con->prepare($sql);
        $statement->bindParam(':size', $size);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function createProductColor($color)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'insert into product_color(color) values (:color)';
        $statement = $con->prepare($sql);
        $statement->bindParam(':color', $color);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProductSize($id, $size)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'update product_size set size=:size where size_id=:id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':size', $size);
        $statement->bindParam(':id', $id);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function updateProductColor($id, $color)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'update product_color set color=:color where color_id=:id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':color', $color);
        $statement->bindParam(':id', $id);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addNewProduct($name, $price, $sub_id, $type_id, $des)
    {

        // Connect to the database
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $date = date('d-m-Y H:i');

        // 1. Insert into product table
        $sql = "INSERT INTO product (product_name, description, price, status, type_id, sub_id, state,date)
                VALUES (:name, :des, :price, 0 , :type_id, :sub_id, 'None',:date)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':des', $des);
        $statement->bindParam(':price', $price);
        $statement->bindParam(':type_id', $type_id);
        $statement->bindParam(':sub_id', $sub_id);
        $statement->bindParam(':date', $date);
        $statement->execute();

        $product_id = $con->lastInsertId(); // Get the ID of the last inserted product
        return $product_id;
    }

    public function addNewMoreImage($image, $product_id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO product_image (image_name, product_id) VALUES (:image, :product_id)";
        $statement = $con->prepare($sql);
        $statement->bindParam(':image', $image);
        $statement->bindParam(':product_id', $product_id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function increaseProductQty($d_id, $increaseQty)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Retrieve quantity from product_detail
        $sql_get_qty = 'SELECT qty FROM product_detail WHERE d_id = :d_id';
        $statement_get_qty = $con->prepare($sql_get_qty);
        $statement_get_qty->bindParam(':d_id', $d_id);
        $statement_get_qty->execute();
        $product_detail = $statement_get_qty->fetch(PDO::FETCH_ASSOC);
        $old_qty = $product_detail['qty'];
    
        $new_qty = $old_qty + $increaseQty;
    
            $sql_update = 'UPDATE product_detail SET qty = :quantity WHERE d_id = :d_id';
            $statement_update = $con->prepare($sql_update);
            $statement_update->bindParam(':quantity', $new_qty, PDO::PARAM_INT);
            $statement_update->bindParam(':d_id', $d_id);
            
        if ($statement_update->execute()) {
            return true;
        } else {
            return false;
        }
    
 
    }
    public function decreaseProductQty($d_id, $decreaseQty)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Retrieve quantity from product_detail
        $sql_get_qty = 'SELECT qty FROM product_detail WHERE d_id = :d_id';
        $statement_get_qty = $con->prepare($sql_get_qty);
        $statement_get_qty->bindParam(':d_id', $d_id);
        $statement_get_qty->execute();
        $product_detail = $statement_get_qty->fetch(PDO::FETCH_ASSOC);
        $old_qty = $product_detail['qty'];

        if($old_qty > $decreaseQty){
            $new_qty = $old_qty - $decreaseQty;
    
            $sql_update = 'UPDATE product_detail SET qty = :quantity WHERE d_id = :d_id';
            $statement_update = $con->prepare($sql_update);
            $statement_update->bindParam(':quantity', $new_qty, PDO::PARAM_INT);
            $statement_update->bindParam(':d_id', $d_id);
            
            if ($statement_update->execute()) {
                return true;
            } else {
                return false;
            }
            
        }else{
            return false;
        }
    

    
 
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
        $sql = "select color from product_color where color_id='$color_id' ORDER BY color_id DESC";
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
        $sql = "select size from product_size where size_id='$size_id' ORDER BY size_id DESC";
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
        $sql = "select * from category ORDER BY category_id DESC";
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
        $sql = "select * from product_color ORDER BY color_id DESC";
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
        $sql = "select * from product_size ORDER BY size_id DESC";
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

    public function updateProduct($id, $product_name, $sub_id, $type_id, $price, $des, $state)
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
    public function updateProductStatus($pid, $edit_status)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if ($edit_status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        $sql = "update product set status=:status
         where product_id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $pid);
        $statement->bindParam(':status', $status);

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
    public function getDeleteImageName($image_id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select image_name from product_image where image_id=:image_id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':image_id', $image_id);
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return $result;
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
    public function deleteProductSizeInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "delete from product_size where size_id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    public function deleteProductColorInfo($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "delete from product_color where color_id=:id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        try {
            $statement->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }


    // *************************user interface**************************


    public function getProductsInfoByType($typeId)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'select * from product where type_id=:id and status =1';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $typeId);

        if ($statement->execute()) {
            $result = $statement->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function getProductsInfoBySubCategory($subCategoryId)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'select * from product where sub_id=:id and status =1';

        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $subCategoryId);

        if ($statement->execute()) {
            $result = $statement->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function getSizeDistictInfo($product_id)
    {
        $con = Database::connect(); // Replace Database::connect() with your database connection method

        $sql = "SELECT DISTINCT ps.size_id, ps.size
                FROM product_detail pd
                JOIN product_size ps ON pd.size = ps.size_id
                WHERE pd.product_id = :id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $product_id);

        if ($statement->execute()) {
            $result = $statement->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        }
    }

    public function getColorsInfoBySize($size, $product_id)
    {
        $con = Database::connect(); // Replace Database::connect() with your database connection method

        $sql = "SELECT DISTINCT pc.color_id, pc.color, pd.d_id, pd.product_id, pd.qty
        FROM product_detail pd
        JOIN product_color pc ON pd.color = pc.color_id
        WHERE pd.size = :size AND pd.product_id = :product_id";

        $statement = $con->prepare($sql);
        $statement->bindParam(':size', $size);
        $statement->bindParam(':product_id', $product_id);

        if ($statement->execute()) {
            $result = $statement->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        }
    }


    public function getRandomImageList($id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $sql = "select * from product_image where product_id=:id";
        $sql = "SELECT * FROM product_image WHERE product_id = :id ORDER BY RAND() LIMIT 1";

        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $id);
        // if ($statement->execute()) {
        //     $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //     return $result;
        // } else {
        //     return []; // Return an empty array if execution fails
        // }
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } else {
            return []; // Return an empty array if execution fails
        }
    }
}
