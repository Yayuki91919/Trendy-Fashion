<?php
include_once __DIR__ . '../../vendor/db/db.php';

class Cart
{

    public function getCart($cid)
    {
        $con = Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "
        select 
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
            customer_id=:cid
        GROUP BY 
            d.product_id";
        $statement = $con->prepare($sql);
        $statement->bindParam(':cid', $cid);
        if ($statement->execute()) {
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function deleteCart($cart_id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='delete from cart where cart_id=:id';
        $statement=$con->prepare($sql);
        $statement->bindParam('id',$cart_id);
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
