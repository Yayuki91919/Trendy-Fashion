<?php
include_once __DIR__. '../../vendor/db/db.php';

class Banner{
    public function getBannerList(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select * from banner";
        $statement=$con->prepare($sql);
        if($statement->execute()){
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;

    }
    public function getCustomerById($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select * from customer_account where customer_id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result ;
        }

    }
    
    public function createBanner($title,$image,$sub_id)
    {
                $con=Database::connect();
                $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql='insert into banner(title,image,sub_id) values (:title,:image,:sub_id)';
                $statement=$con->prepare($sql);
                $statement->bindParam(':title',$title);
                $statement->bindParam(':image',$image);
                $statement->bindParam(':sub_id',$sub_id);
                if($statement->execute())
                {
                    return true;
                }
                else{
                    return false;
                }
    }
    public function updateCustomer($id,$name,$email,$phone)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='update customer_account set username=:name,email=:email,phone=:phone where customer_id=:id';
        $statement=$con->prepare($sql);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':email',$email);
        $statement->bindParam(':phone',$phone);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            return true;
        }
        else{
            return false;
        }
    }
    public function deleteCustomerInfo($id)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='delete from customer_account where customer_id=:id';
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