<?php
include_once __DIR__. '../../vendor/db/db.php';

class Location{
    public function getLocationById($id){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="SELECT * FROM location WHERE location_id=:id";
        $statement=$con->prepare($sql);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

    }
    public function getLocationInfo(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="select * from location";
        $statement=$con->prepare($sql);
        if($statement->execute()){
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function addNewLocation($city,$township){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="insert into location(city,township) 
        value (:city,:township)";
        $statement=$con->prepare($sql);
        $statement->bindParam(':city',$city);
        $statement->bindParam(':township',$township);
        if($statement->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function updateLocation($id,$city,$town)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='update location set city=:city,township=:town where location_id=:id';
        $statement=$con->prepare($sql);
        $statement->bindParam(':city',$city);
        $statement->bindParam(':town',$town);
        $statement->bindParam(':id',$id);
        if($statement->execute())
        {
            return true;
        }
        else{
            return false;
        }
    }
    public function getLastId(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT MAX(location_id) AS last_id FROM location";
        $statement=$con->prepare($sql);
        if($statement->execute())
        {
            $result=$statement->fetch(PDO::FETCH_ASSOC);
            return $result;
        }
    }
    public function getLocationFee(){
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="SELECT l.location_id, l.city, l.township,
        df.fee_id, df.fee
        FROM location l
        LEFT JOIN deli_fee df ON l.location_id = df.location_id";
        $statement=$con->prepare($sql);
        if($statement->execute()){
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function deleteLocationInfo($id)
    {
        $con=Database::connect();
        $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql='delete from location where location_id=:id';
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