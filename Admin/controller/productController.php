<?php
include_once __DIR__ . '/../model/product.php';

class productController extends Product
{

    public function getProduct()
    {
        return $this->getProductList();
    }
    public function getPublicProduct()
    {
        return $this->getPublicProductList();
    }
    public function getPublicProductByCategory($cid)
    {
        return $this->getProductByCategory($cid);
    }
    public function getProductSize()
    {
        return $this->getProductSizeList();
    }
    public function getProductColor()
    {
        return $this->getProductColorList();
    }
    public function addProductSize($size)
    {
        return $this->createProductSize($size);

    }
    public function addProductColor($color)
    {
        return $this->createProductColor($color);

    }
    public function editProductSize($id,$size)
        {
            return $this->updateProductSize($id,$size);
        }
        public function editProductColor($id,$color)
        {
            return $this->updateProductColor($id,$color);
        }
    
    public function addProduct($name, $price, $sub_id, $type_id, $des)
    {

        return $this->addNewProduct($name, $price, $sub_id, $type_id, $des);
    }
    
    public function addMoreImage($id, $images)
    {
        return $this->addNewMoreImage($images, $id);

    }
    public function getImageName($image_id)
    {
        return $this->getDeleteImageName($image_id);

    }
   
    public function addSize_Color($color_id,$color,$size_id,$size,$qty)
    {
         return $this->addSizeColorlist($color_id,$color,$size_id,$size,$qty);
        // return "$color_id,$color,$size_id,$size,$qty";

         
    }
    public function addMoreSizeColor($size_id,$color_id,$qty,$id)
    {

         return $this->addMoreSizeColorlist($size_id,$color_id,$qty,$id);

    }
    public function increaseQty($d_id, $increaseQty)
    {
        return $this->increaseProductQty($d_id, $increaseQty);

    }
    public function decreaseQty($d_id, $decreaseQty)
    {
        return $this->decreaseProductQty($d_id, $decreaseQty);

    }

    public function getCategory()
    {
        return $this->getCategoryList();
    }
    public function getSize_Color()
    {
        return $this->getSizeColor();
    }
    public function getSizeColorDetail($id)
    {
        return $this->getSizeColorInfo($id);
    }
    public function getImages($id)
    {
        return $this->getImageList($id);
    }
    public function getColors()
    {
        return $this->getColorList();
    }
    public function getSizes()
    {
        return $this->getSizeList();
    }

    public function getColor($color_id)
    {
        return $this->getColorInfo($color_id);
        
    }
    public function getSize($size_id)
    {
        return $this->getSizeInfo($size_id);
        
    }


    public function getProducts($id)
    {
        return $this->getProductInfo($id);
    }
    public function editProduct($id,$product_name,$sub_id,$type_id,$price,$des,$state)
    {
        return $this->updateProduct($id,$product_name,$sub_id,$type_id,$price,$des,$state);
    }
    public function updateStatus($pid,$edit_status)
    {
        return $this->updateProductStatus($pid,$edit_status);
    }

    public function deleteSizeColor($id)
    {
        return $this->deleteSizeColorInfo($id);
    }
    public function deleteTemp($id)
    {
        return $this->deleteTempInfo($id);
    }
    public function deleteProductSize($delete_id)
    {
        return $this->deleteProductSizeInfo($delete_id);
    }
    public function deleteProductColor($delete_id)
    {
        return $this->deleteProductColorInfo($delete_id);
    }
    

    public function deleteProduct($id)
    {
        return $this->deleteProductInfo($id);
    }
    public function delete_image($delete_image)
    {
        return $this->deleteImageInfo($delete_image);
    }
    public function delete_product_detail($product_detail_id)
    {
        return $this->deleteProductDetailInfo($product_detail_id);
    }

// ************************* user Interface *********************************

    public function getProductsByType($typeId)
    {
        return $this->getProductsInfoByType($typeId);
    }
    public function getProductsBySubCategory($subCategoryId)
    {
        return $this->getProductsInfoBySubCategory($subCategoryId);
    }
    
    public function getColorsBySize($size,$product_id)
    {
        return $this->getColorsInfoBySize($size,$product_id);
    }
    public function getRandomImages($id)
    {
        return $this->getRandomImageList($id);
    }
    public function getSizeDistinct($product_id)
    {
        return $this->getSizeDistinctInfo($product_id);
    }
    public function checkSoldOut($product_id)
    {
        return $this->soldOut($product_id);
    }

}
