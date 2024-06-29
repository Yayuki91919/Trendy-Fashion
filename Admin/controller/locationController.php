<?php

include_once __DIR__. '../../model/location.php';

class LocationController extends Location{
        public function getLocationList(){
            return $this->getLocationInfo();
        }
        public function getLocationListById($id){
            return $this->getLocationById($id);
        }
        public function createNewLocation($city,$township){
            return $this->addNewLocation($city,$township);
        }
        public function editLocation($id,$city,$town)
        {
            return $this->updateLocation($id,$city,$town);
        }
        public function getLastInsertId(){
            return $this->getLastId();
        }
        public function getLocationFeeInfo(){
            return $this->getLocationFee();
        }
        public function deleteLocation($id)
        {
            return $this->deleteLocationInfo($id);
        }
}
?>