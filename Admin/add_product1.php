 <?php
    include_once 'layouts/header.php';
    include_once __DIR__ . '../controller/categoryController.php';
    include_once __DIR__ . '../controller/subController.php';
    include_once __DIR__ . '../controller/typeController.php';


    $cat_controller = new CategoryController();
    $categories = $cat_controller->getCategoriesWithSub();

    $sub_controller = new SubCategoryController();
    $subs = $sub_controller->getSubCategories();

    $type_controller = new typeController();
    $types = $type_controller->getTypes();



    // insert 
    if (isset($_POST['addProduct'])) {
        echo "hello";
        $name = $_POST['name'];
        $price = $_POST['price'];
        $cat_id = $_POST['cat_id'];
        $sub_id = $_POST['sub_id'];


        echo "$name<hr>$price<hr>$cat_id<hr>$sub_id";

        //$status=$type_controller->addType($name);
        // if($status)
        // {
        //echo '<script> location.href="product_type.php</script>';
        // }

    }

    //   get edit data to update
    // if(isset($_GET['edit_id']))
    // {
    //     $type_id = $_GET['edit_id'];
    //     $type = $type_controller->getType($type_id);
    // }

    // if(isset($_POST['edit']))
    // {
    //     $name=$_POST['name'];
    //     $status=$type_controller->editType($type_id,$name);
    //     if($status)
    //     {
    //         $message=2;
    //         echo '<script> location.href="product_type.php?status='.$status.'"</script>';
    //     }
    // }


    ?>


 <!--**********************************
            Content body start
        ***********************************-->

 <div class="content-body">
     <div class="row page-titles mx-0">
         <div class="col p-md-0">
             <ol class="breadcrumb">
                 <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                 <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Product</a></li>
             </ol>
         </div>
     </div>
     <!-- row -->

     <div class="container-fluid">
         <div class="row">
             <div class="col-lg-12  ">
                 <div class="card">
                     <div class="card-body">
                         <?php if (isset($_GET['edit_id'])) {
                            ?>

                             <h4 class="card-title"> Product Form</h4>
                             <p>Enter Product Name</p>
                             <div class="basic-form">
                                 <form action="<?php $_PHP_SELF ?>" method="post" class="form-inline">
                                     <div class="form-group mx-sm-3 mb-2">
                                         <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $type['name']; ?>">
                                     </div>
                                     <input type="submit" class="btn gradient-3 mb-2" value="Update" name="edit">
                                 </form>
                             </div>

                         <?php } else { ?>

                             
                             <h4 class="card-title">Add Product Form</h4>
                             <form action="<?php $_PHP_SELF ?>" method="post">
                                 <div class="row">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="name">Product Name:</label>
                                             <input type="text" id="name" name="name" class="form-control" placeholder="Enter product name" style="width: 100%;">
                                         </div>
                                     </div>
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="price">Price:</label>
                                             <input type="text" id="price" name="price" class="form-control" placeholder="Enter price" style="width: 100%;">
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="name">Category</label>
                                             <select name="cat_id" class="custom-select mr-sm-2" id="categorySelect">
                                                 <option>Choose Category</option>
                                                 <?php foreach ($categories as $category) : ?>
                                                     <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                                                 <?php endforeach; ?>
                                             </select>
                                         </div>
                                     </div>
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="price">Sub Category</label>
                                             <select name="sub_id" class="custom-select mr-sm-2" id="subCategorySelect">

                                             </select>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="des">Description:</label>
                                             <!-- <textarea id="description" name="des" class="custom-select " name="description" placeholder="Description" style="width: 100%;"></textarea> -->
                                             <textarea id="description" name="des" class="form-control" placeholder="Description" rows="5" style="width: 100%;"></textarea>

                                         </div>
                                     </div>
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <label for="name">Type</label>
                                             <select name="cat_id" class="custom-select mr-sm-2" id="categorySelect">
                                                 <option>Choose Type</option>
                                                 <?php foreach ($types as $type) : ?>
                                                     <option value="<?php echo $type['type_id']; ?>"><?php echo $type['name']; ?></option>
                                                 <?php endforeach; ?>
                                             </select>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-12">
                                         <div class="form-group">
                                             <div style="max-width: 100%; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                                                 <label style="font-weight: bold;">Select Images:</label>
                                                 <!-- <input type="file" name="img" accept="image/*" multiple  style="display: block; margin-top: 10px;"> -->
                                                 <input type="file" name="img" accept="image/*" multiple class="form-control" placeholder="Choose Images" required id="imageInput">

                                                 <div id="previewContainer" style="display: flex; flex-wrap: wrap; margin-top: 10px;">

                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <hr>

                                 <div class="row">
                                     <div class="col-md-12">
                                         <div id="sizeColorContainer" class="card">
                                             <div class="card-header bg-info">
                                                 <h5 class="mb-0 text-white">Sizes and Colors</h5>
                                             </div>
                                             <div class="card-body">
                                                 <div id="sizeColorRows">
                                                     <div class="card mb-3 size-row" id="row_1">
                                                         <div class="card-body">
                                                             <div class="form-row">
                                                                 <div class="col-md-3">
                                                                     <label for="size">Size:</label>
                                                                     <input type="text" id="size" name="sizes[1][name]" class="form-control" required>
                                                                 </div>
                                                                 <div class="col-md-6">
                                                                     <label>Colors:</label>
                                                                     <div class="colors-container" id="row_1_colors">
                                                                         <div class="form-row align-items-center mt-2 color-group">
                                                                             <div class="col-md-5">
                                                                                 <input type="text" name="sizes[1][colors][1][name]" class="form-control" placeholder="Color" required>
                                                                             </div>
                                                                             <div class="col-md-5">
                                                                                 <input type="number" name="sizes[1][colors][1][quantity]" class="form-control" placeholder="Quantity" required>
                                                                             </div>
                                                                             <div class="col-md-2 text-right">
                                                                                 <button type="button" class="removeColorButton btn btn-outline-danger">Remove</button>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                     <button type="button" class="addColorButton text-white btn btn-success mt-2">Add Color</button>
                                                                 </div>
                                                                 <div class="col-md-3 d-flex align-items-end justify-content-end">
                                                                     <button type="button" class="removeRowButton btn btn-danger">Remove Size</button>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <button type="button" id="addSizeColorButton" class="btn btn-primary mt-3">Add Size and Color</button>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 <hr>
                                 <input type="submit" value="Add Product" class="btn btn-success" name="addProduct">
                             </form>




                         <?php }
                            ?>

                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- #/ container -->
 </div>
 <!--**********************************
            Content body end
        ***********************************-->

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


 <!-- *********************Image preview*************************** -->
 <script>
     $(document).ready(function() {
         document.getElementById('imageInput').addEventListener('change', function(event) {
             // console.log('File input changed'); // Debugging log
             const previewContainer = document.getElementById('previewContainer');
             previewContainer.innerHTML = ''; // Clear previous images
             const files = event.target.files;

             if (files.length === 0) {
                 console.log('No files selected'); // Debugging log
                 return;
             }

             for (const file of files) {
                 const reader = new FileReader();
                 reader.onload = function(e) {
                     // console.log('File loaded'); // Debugging log
                     const img = document.createElement('img');
                     img.src = e.target.result;
                     img.classList.add('preview-image');
                     previewContainer.appendChild(img);
                 }
                 reader.readAsDataURL(file);
             }
         });
     });
 </script>


 <!-- ***********************Sub Category************************* -->
 <script>
     $(document).ready(function() {
         $('#categorySelect').change(function() {
             var category_id = $(this).val(); // Get the selected category ID
             $.ajax({
                 type: 'POST',
                 url: 'get_subcategories.php',
                 data: {
                     category_id: category_id
                 },
                 dataType: 'json', // Ensure this is set to 'json'
                 success: function(response) {
                     $('#subCategorySelect').empty();
                     $.each(response, function(index, subcategory) {
                         $('#subCategorySelect').append('<option value="' + subcategory.sub_id + '">' + subcategory.brand_name + '</option>');
                         console.log(subcategory.sub_id); // Log each sub_id
                     });
                 },
                 error: function(xhr, status, error) {
                     console.error('AJAX Error: ' + status + ': ' + error);
                 }
             });
         });
         // $('#productForm').submit(function(event) {
         //     // Prevent form submission
         //     event.preventDefault();

         //     // Check if the selected value is the default ("Choose Category")
         //     var category_id = $('#categorySelect').val();
         //     if (category_id === "") {
         //         // Show an error message or take other action (e.g., highlight the select box)
         //         alert('Please select a category.');
         //         return false; // Prevent form submission
         //     }
         // });
     });
 </script>


 <!-- ********************Sizes and colors**************************** -->
 <script>
     $(document).ready(function() {
         var sizeIndex = 1; // Initialize sizeIndex starting from 1 (assuming row_1 exists initially)
         var colorIndex = 1; // Initialize colorIndex starting from 1
         var sizeName = "";

         $('#addSizeColorButton').click(function() {
             var newRow = `
            <div class="card mb-3 size-row" id="row_${sizeIndex}">
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-3">
                            <label for="size">Size:</label>
                            <input type="text" name="sizes[${sizeIndex}][name]" class="form-control" required id="size_input">
                        </div>
                        <div class="col-md-6">
                            <label>Colors:</label>
                            <div class="colors-container" id="row_${sizeIndex}_colors">
                                <div class="form-row align-items-center mt-2 color-group">
                                    <div class="col-md-5">
                                        <input type="text" name="${sizeIndex}_colors[${colorIndex}][name]" class="form-control" placeholder="Color" required>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="number" name="${sizeIndex}_colors[${colorIndex}][quantity]" class="form-control" placeholder="Quantity" required>
                                    </div>
                                    <div class="col-md-2 text-right">
                                        <button type="button" class="removeColorButton btn btn-outline-danger">Remove</button>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="addColorButton text-white btn btn-success mt-2">Add Color</button>
                        </div>
                        <div class="col-md-3 d-flex align-items-end justify-content-end">
                            <button type="button" class="removeRowButton btn btn-danger">Remove Size</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
            
             $('#sizeColorRows').append(newRow);
             sizeIndex++;
         });

         $(document).on('click', '.addColorButton', function() {
             var parent = $(this).closest('.size-row');
             var rowId = parent.attr('id');
            
             var colorsContainer = parent.find('.colors-container');
             var newColorGroup = `
            <div class="form-row align-items-center mt-2 color-group">
                <div class="col-md-5">
                    <input type="text" name="sizes[${sizeIndex}][name]" value="sizes[${sizeIndex}][name]" class="form-control" required>
                    <input type="text" name="${rowId}_colors[${colorIndex}][name]" class="form-control" placeholder="Color" required>
                </div>
                <div class="col-md-5">
                    <input type="number" name="${rowId}_colors[${colorIndex}][quantity]" class="form-control" placeholder="Quantity" required>
                </div>
                <div class="col-md-2 text-right">
                    <button type="button" class="removeColorButton btn btn-outline-danger">Remove</button>
                </div>
            </div>
        `;
             colorsContainer.append(newColorGroup);
             colorIndex++;
         });

         $(document).on('click', '.removeColorButton', function() {
             var colorGroups = $(this).closest('.colors-container').find('.color-group');
             if (colorGroups.length > 1) {
                 $(this).closest('.color-group').remove();
             }
         });

         $(document).on('click', '.removeRowButton', function() {
             var sizeRows = $('#sizeColorRows').find('.size-row');
             if (sizeRows.length > 1) {
                 $(this).closest('.size-row').remove();
             }
         });
     });
 </script>

 <?php
    include_once 'layouts/footer.php';
    ?>