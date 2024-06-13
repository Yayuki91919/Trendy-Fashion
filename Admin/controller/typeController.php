<?php

include_once __DIR__. '../../model/type.php';

class typeController extends Type{
        public function getTypes(){
            return $this->getTypesList();
        }

        public function addType($name)
        {
            return $this->createType($name);

        }

        public function getType($id)
        {
            return $this->getTypeInfo($id);
        }

        public function editType($id,$name)
        {
            return $this->updateType($id,$name);
        }

        public function deleteType($id)
        {
            return $this->deleteTypeInfo($id);
        }


}
?>