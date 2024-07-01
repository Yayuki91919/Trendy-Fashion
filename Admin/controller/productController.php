<?php
include_once __DIR__ . '/../model/product.php';

class productController extends Product
{

    public function getProduct()
    {
        return $this->getProductList();
    }
    
    // public function addProduct($name, $price, $cat_id, $sub_id, $type_id, $des, $image)
    // {
    //     $uploaded_filenames = [];
        
    //     foreach ($image['error'] as $key => $error) {
    //         if ($error == 0) {
    //             $filename = $image['name'][$key];
    //             $extension = explode('.', $filename);
    //             $filetype = end($extension);
    //             $filesize = $image['size'][$key];
    //             $allowed_types = ['jpg', 'jpeg', 'svg', 'png', 'webp'];
    //             $temp_file = $image['tmp_name'][$key];
                
    //             if (in_array($filetype, $allowed_types)) {
    //                 if ($filesize <= 2000000) {
    //                     $timestamp = time();
    //                     $new_filename = $timestamp . $filename;
                        
    //                     if (move_uploaded_file($temp_file, '../images/product/' . $new_filename)) {
    //                         $uploaded_filenames[] = $new_filename;
    //                     }
    //                 }
    //             }
    //         }
    //     }
        
    //     if (!empty($uploaded_filenames)) {
    //          return $this->addNewProduct($uploaded_filenames, $name, $price, $cat_id, $sub_id, $type_id, $des);
    //     }
    
    // }

    public function addProduct($name, $price, $sub_id, $type_id, $des, $images)
    {
        // Check if the image array is properly structured
        if (!isset($images['error']) || !is_array($images['error'])) {
            return "Invalid file upload structure.";
        }
    
        // Debug output for form values
        // echo "Name: $name<br>";
        // echo "Price: $price<br>";
        // echo "Category ID: $cat_id<br>";
        // echo "Subcategory ID: $sub_id<br>";
        // echo "Type ID: $type_id<br>";
        // echo "Description: $des<br>";
    
        $uploaded_filenames = [];
    
        // Ensure the target directory exists
        $target_directory = '../images/product/';
        if (!is_dir($target_directory)) {
            mkdir($target_directory, 0755, true);
        }
    
        foreach ($images['error'] as $key => $error) {
            if ($error == 0) {
                $filename = $images['name'][$key];
                $extension = explode('.', $filename);
                $filetype = end($extension);
                $filesize = $images['size'][$key];
                $allowed_types = ['jpg', 'jpeg', 'svg', 'png', 'webp'];
                $temp_file = $images['tmp_name'][$key];
                $target_directory = './images/product/';

    
                if (in_array($filetype, $allowed_types)) {
                    if ($filesize <= 2000000) {
                        $timestamp = time();
                        $new_filename = $timestamp . '_' . $filename;
    
                        // Move uploaded file to target directory
                        if (move_uploaded_file($temp_file, $target_directory . $new_filename)) {
                            $uploaded_filenames[] = $new_filename;
                        } else {
                            echo "Failed to move file: $filename<br>";
                        }
                    } else {
                        echo "File $filename exceeds size limit.<br>";
                    }
                } else {
                    echo "File type $filetype not allowed for file $filename.<br>";
                }
            } else {
                echo "Error uploading file:  Error code: $error<br>";
            }
        }
    
        if (!empty($uploaded_filenames)) {
            // Return uploaded filenames or call a function to handle the next step
            // return "Uploaded files: " . implode(', ', $uploaded_filenames);
            
            return $this->addNewProduct($uploaded_filenames, $name, $price, $sub_id, $type_id, $des);


        }
    
        // Optionally, handle cases where no files were uploaded successfully
        return "No files were uploaded successfully.";
    }
    


    
    
    public function addSize_Color($color_id,$color,$size_id,$size,$qty)
    {
         return $this->addSizeColorlist($color_id,$color,$size_id,$size,$qty);
        // return "$color_id,$color,$size_id,$size,$qty";

         
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

    public function deleteSizeColor($id)
    {
        return $this->deleteSizeColorInfo($id);
    }
    public function deleteProduct($id)
    {
        return $this->deleteProductInfo($id);
    }
}
