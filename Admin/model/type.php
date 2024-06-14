<?php
include_once __DIR__. '../../vendor/db/db.php';

class Type{
    public function getTypesList(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select * from type";
        $statement=$con->prepare($sql);
        if($statement->execute())
        {
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;

    }

    public function createType($name)
    {
                $con=Database::connect();
                $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql='insert into type(name) values (:name)';
                $statement=$con->prepare($sql);
                $statement->bindParam(':name',$name);
                if($statement->execute())
                {
                    return true;
                }
                else{
                    return false;
                }
    }

    
    public function getTypeInfo($id)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='select * from type where type_id=:id';
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);

        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }                                                
    }

    public function updateType($id,$name)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='update type set name=:name where type_id=:id';
        $statement=$con->prepare($sql);
        $statement->bindParam(':name',$name);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            return true;
        }
        else{
            return false;
        }
    }

  
    public function deleteTypeInfo($id)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='delete from type where type_id=:id';
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