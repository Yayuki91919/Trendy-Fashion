<?php

include_once __DIR__. '../../model/SubCategory.php';

class SubCategoryController extends SubCategory{

        public function getSubCategories(){
            return $this->getSubCategoriesList();
            
        }

        public function addSubCategory($sub_id,$name,$cat_id)
        {
            return $this->createSubCategory($sub_id,$name,$cat_id);

        }

        public function getSubCategory($id)
        {
            return $this->getSubCategoryInfo($id);
        }

        public function editSubCategory($id,$name,$cat_id)
        {
            return $this->updateSubCategory($id,$name,$cat_id);
        }

        // public function deleteSubCategory($id)
        // {
        //     return $this->deleteSubCategoryInfo($id);
        // }


}
?>