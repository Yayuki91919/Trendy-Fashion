<?php
include_once __DIR__ . '../../vendor/db/db.php';

class Cart
{

    public function getCart($cid)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
    SELECT 
        c.cart_id,
        d.product_id,
        c.customer_id,
        c.quantity,
        ps.size,
        pc.color, 
        p.product_name,
        p.description,
        p.price,
        p.status,
        p.type_id,
        p.sub_id,
        p.state,
        (SELECT image_name 
         FROM product_image 
         WHERE product_id = d.product_id 
         ORDER BY RAND() 
         LIMIT 1) AS random_image
    FROM 
        cart AS c
    JOIN 
        product_detail AS d ON c.d_id = d.d_id
    JOIN 
        product AS p ON p.product_id = d.product_id
    JOIN 
        product_size AS ps ON ps.size_id = d.size
    JOIN 
        product_color AS pc ON pc.color_id = d.color
    WHERE 
        c.customer_id = :cid
";


        $statement = $con->prepare($sql);
        $statement->bindParam(':cid', $cid);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function getEditCartInfo($cart_id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
        select 
            c.cart_id,
            d.d_id,
            d.product_id,
            d.qty as max_qty,
            c.customer_id,
            c.quantity,
            ps.size,
            pc.color,
            ps.size_id,
            pc.color_id, 
            p.product_name,
            p.description,
            p.price,
            p.status,
            p.type_id,
            p.sub_id,
            p.state,
            (SELECT image_name 
            FROM product_image 
            WHERE product_id = d.product_id 
            ORDER BY RAND() 
            LIMIT 1) AS random_image
        from 
            cart as c
        join
            product_detail as d on c.d_id = d.d_id
        join 
            product as p on p.product_id = d.product_id
        join
            product_size as ps on ps.size_id = d.size
        join
            product_color as pc on pc.color_id = d.color
        where 
            cart_id = :cart_id";

        $statement = $con->prepare($sql);
        $statement->bindParam(':cart_id', $cart_id);
        if ($statement->execute()) {
            $result = $statement->fetch(PDO::FETCH_ASSOC);
        }
        return $result;
    }



    public function deleteCart($cart_id)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'delete from cart where cart_id=:id';
        $statement = $con->prepare($sql);
        $statement->bindParam(':id', $cart_id);
        $statement->bindParam('id', $cart_id);
        try {
            $statement->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }


    public function addCart($d_id, $cid, $quantity)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Retrieve available quantity from product_detail
        $sql_get_qty = 'SELECT qty FROM product_detail WHERE d_id = :d_id';
        $statement_get_qty = $con->prepare($sql_get_qty);
        $statement_get_qty->bindParam(':d_id', $d_id);
        $statement_get_qty->execute();
        $product_detail = $statement_get_qty->fetch(PDO::FETCH_ASSOC);
        $available_qty = $product_detail['qty'];
    
        // Check if quantity to be added exceeds available quantity in product_detail
        if ($quantity > $available_qty) {
            echo "Error: Quantity exceeds available stock.";
            return false;
        }
    
        // Check if d_id already exists in cart for this customer
        $sql_check = 'SELECT * FROM cart WHERE d_id = :d_id AND customer_id = :cid';
        $statement_check = $con->prepare($sql_check);
        $statement_check->bindParam(':d_id', $d_id);
        $statement_check->bindParam(':cid', $cid);
        $statement_check->execute();
        $existing_cart_item = $statement_check->fetch(PDO::FETCH_ASSOC);
    
        if ($existing_cart_item) {
            // Update quantity if d_id exists in cart for this customer
            $new_quantity = $existing_cart_item['quantity'] + $quantity;
    
            // Check if updated quantity exceeds available stock
            if ($new_quantity > $available_qty) {
                echo "Error: Quantity exceeds available stock.";
                return false;
            }
    
            $sql_update = 'UPDATE cart SET quantity = :quantity WHERE d_id = :d_id AND customer_id = :cid';
            $statement_update = $con->prepare($sql_update);
            $statement_update->bindParam(':quantity', $new_quantity, PDO::PARAM_INT);
            $statement_update->bindParam(':d_id', $d_id);
            $statement_update->bindParam(':cid', $cid);
    
            try {
                if ($statement_update->execute()) {
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                // Handle update exception
                //echo "Error updating quantity: " . $e->getMessage();
                return false;
            }
        } else {
            // Insert new record if d_id does not exist for this customer
            $sql_insert = 'INSERT INTO cart (customer_id, quantity, d_id) VALUES (:cid, :quantity, :d_id)';
            $statement_insert = $con->prepare($sql_insert);
            $statement_insert->bindParam(':cid', $cid);
            $statement_insert->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $statement_insert->bindParam(':d_id', $d_id);
    
            try {
                if ($statement_insert->execute()) {
                    return true;
                } else {
                    return false;
                }
            } catch (PDOException $e) {
                // Handle insert exception
                //echo "Error inserting into cart: " . $e->getMessage();
                return false;
            }
        }
    }

    public function updateCartQty($d_id,$cid,$quantity)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql_update = 'UPDATE cart SET quantity = :quantity WHERE d_id = :d_id AND customer_id = :cid';
        $statement_update = $con->prepare($sql_update);
        $statement_update->bindParam(':quantity', $quantity);
        $statement_update->bindParam(':d_id', $d_id);
        $statement_update->bindParam(':cid', $cid);

        try {
            if ($statement_update->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Handle update exception
            //echo "Error updating quantity: " . $e->getMessage();
            return false;
        }
    
    }
    
}
