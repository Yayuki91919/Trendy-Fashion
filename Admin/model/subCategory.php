<?php
include_once __DIR__. '../../vendor/db/db.php';

class SubCategory{
    public function getSubCategoriesList(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // $sql="select * from sub_category ORDER BY sub_id DESC";
        
        $sql = "SELECT sc.*, c.category_name 
        FROM sub_category sc 
        INNER JOIN category c ON sc.category_id = c.category_id 
        ORDER BY sc.sub_id DESC";

        $statement=$con->prepare($sql);
        if($statement->execute())
        {
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    public function createSubCategory($name,$cat_id)
    {
                $con=Database::connect();
                $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql='insert into sub_category(brand_name,category_id) values (:name,:cat_id)';
                $statement=$con->prepare($sql);
                $statement->bindParam(':name',$name);
                $statement->bindParam(':cat_id',$cat_id);
                if($statement->execute())
                {
                    return true;
                }
                else{
                    return false;
                }
    }

    
    public function getSubCategoryInfo($id)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='select * from sub_category where sub_id=:id';
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);

        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }                                                
    }

    public function updateSubCategory($sub_id,$name,$cat_id)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='update sub_category set brand_name=:name, category_id=:cat_id where sub_id=:id';
        $statement=$con->prepare($sql);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':id',$sub_id);
        $statement->bindParam(':cat_id',$cat_id);
        if($statement->execute())
        {
            return true;
        }
        else{
            return false;
        }

    }

  
    public function deleteSubCategoryInfo($id)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='delete from category where category_id=:id';
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