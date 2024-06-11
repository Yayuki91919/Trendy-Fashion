<?php
include_once __DIR__ . '/../model/product.php';

class productController extends Product
{

    public function getProduct()
    {
        return $this->getProductList();
    }
    public function addProduct($image, $name, $price, $desp, $category)
    {
        if ($image['error'] == 0) {
            $filename = $image['name'];
            $extension = explode('.', $filename);
            $filetype = end($extension);
            $filesize = $image['size'];
            $allowed_types = ['jpg', 'jpeg', 'svg', 'png', 'webp'];
            $temp_file = $image['tmp_name'];
            if (in_array($filetype, $allowed_types)) {
                if ($filesize <= 2000000) {
                    $timestamp = time();
                    // die(var_dump(($timestamp)));
                    $filename = $timestamp . $filename;
                    if (move_uploaded_file($temp_file, '../uploads/' . $filename))
                        return $this->addNewProduct($filename, $name, $price, $desp, $category);
                }
            }
        }
    }
    public function getCategory()
    {
        return $this->getCategoryList();
    }
    public function getProducts($id)
    {
        return $this->getProductInfo($id);
    }
    public function editProduct($id, $image, $name, $price, $desp, $category)
    {
        $filename = $image['name'];
        $extension = explode('.', $filename);
        $filetype = end($extension);
        $filesize = $image['size'];
        $allowed_types = ['jpg', 'jpeg', 'svg', 'png','webp'];
        $temp_file = $image['tmp_name'];
        if (in_array($filetype, $allowed_types)) {
            if ($filesize <= 2000000) {
                $timestamp = time();
                $filename = $timestamp . $filename;
                if (move_uploaded_file($temp_file, '../uploads/' . $filename))
                    return $this->updateProduct($id, $filename, $name, $price, $desp, $category);
            }
        }
    }

    public function deleteProduct($id)
    {
        return $this->deleteProductInfo($id);
    }
}
