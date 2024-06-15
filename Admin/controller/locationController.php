<?php

include_once __DIR__. '../../model/location.php';

class LocationController extends Location{
        public function getLocationListById($id){
            return $this->getLocationById($id);
        }

}
?>