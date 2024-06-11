<?php
include_once __DIR__. '/../vendor/db/db.php';

class Product{
    public function getCustomerList(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="";
        // $sql='SELECT product.* FROM product JOIN category WHERE cat_id=category.id';
        $statement=$con->prepare($sql);
        if($statement->execute()){
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;

    }
}
?>