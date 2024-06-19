 
<?php
    include_once 'layouts/header.php';
    include_once __DIR__. '../controller/categoryController.php';
    include_once __DIR__. '../controller/subController.php';
    include_once __DIR__. '../controller/typeController.php';


    $cat_controller=new CategoryController();
    $categories=$cat_controller->getCategoriesWithSub();

    $sub_controller=new SubCategoryController();
    $subs=$sub_controller->getSubCategories();

    $type_controller = new typeController();



    // insert 
    if(isset($_POST['add']))
    {
        $name=$_POST['name'];

        $status=$type_controller->addType($name);
        if($status)
        {
            echo '<script> location.href="product_type.php?status='.$status.'"</script>';
        }

    }

    //   get edit data to update
    if(isset($_GET['edit_id']))
    {
        $type_id = $_GET['edit_id'];
        $type = $type_controller->getType($type_id);
    }

    if(isset($_POST['edit']))
    {
        $name=$_POST['name'];
        $status=$type_controller->editType($type_id,$name);
        if($status)
        {
            $message=2;
            echo '<script> location.href="product_type.php?status='.$status.'"</script>';
        }
    }


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
                                <?php if(isset($_GET['edit_id'])){                                    
                                    ?>
                                        
                                <h4 class="card-title">Product Product Form</h4>
                                <p>Enter Product Name</p>
                                <div class="basic-form">
                                    <form action="<?php $_PHP_SELF ?>" method="post" class="form-inline">
                                        <div class="form-group mx-sm-3 mb-2">
                                            <input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo $type['name']; ?>">
                                        </div>
                                        <input type="submit" class="btn gradient-3 mb-2" value="Update" name="edit">
                                    </form>
                                </div>

                                <?php }else{?>

                                    
                                <h4 class="card-title">Add Product Form</h4>
                                <form action="process_form.php" method="post" id="productForm">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Product Name:</label>
                                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter product name"
                                                    style="width: 100%;" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label for="price">Price:</label>
                                            <input type="text" id="price" name="price" class="form-control" placeholder="Enter price"
                                                style="width: 100%;" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Category</label>
                                                <select name="cat_id" class="custom-select mr-sm-2" id="categorySelect">
                                                    <option>Choose Category</option>
                                                    <?php foreach($categories as $category): ?>
                                                        <option value="<?php  echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price">Sub Category</label>
                                                <select name="sub_cat_id" class="custom-select mr-sm-2" id="subCategorySelect">
                                                    <!-- Options will be populated dynamically -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Product Type:</label>
                                                <input type="text" id="name" name="name" class="form-control" placeholder="Enter product name"
                                                    style="width: 100%;" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label for="price">Price:</label>
                                            <input type="text" id="price" name="price" class="form-control" placeholder="Enter price"
                                                style="width: 100%;" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="des">Description:</label>
                                        <input type="text" id="des" name="des" class="form-control" placeholder="Enter description"
                                            style="width: 100%;" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div style="max-width: 100%; margin: 0 auto; padding: 20px; background-color: #f9f9f9; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                                            <label style="font-weight: bold;">Select Images:</label>
                                            <input type="file" accept="image/*" multiple onchange="previewImages(event)" style="display: block; margin-top: 10px;">

                                            <div id="previewContainer" style="display: flex; flex-wrap: wrap; margin-top: 10px;">
                                                <!-- Images will be previewed here -->
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div id="sizeColorContainer" style="border: 1px solid #ccc; padding: 10px; border-radius: 5px;">
                                        <label style="font-weight: bold;">Sizes and Colors:</label>
                                        <div id="sizeColorRows">
                                            <div class="row size-row" id="row_1" style="margin-top: 10px; padding: 10px; border: 1px solid #ccc; border-radius: 5px;">
                                                <div class="col-sm-3">
                                                    <label for="size">Size:</label>
                                                    <input type="text" id="size" name="sizes[1][name]" class="form-control mb-2" style="width: 100%;" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>Colors:</label>
                                                    <div class="colors-container" id="row_1_colors">
                                                        <div class="color-group" style="margin-top: 5px; display: flex; align-items: center;">
                                                            <input type="text" name="sizes[1][colors][1][name]" class="form-control" placeholder="Color" style="width: 50%; display: inline-block;" required>
                                                            <input type="number" name="sizes[1][colors][1][quantity]" class="form-control" placeholder="Quantity" style="width: 40%; display: inline-block; margin-left: 10px;" required>
                                                            <button type="button" class="removeColorButton btn btn-outline-danger ml-2">Remove Color</button>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="addColorButton btn btn-secondary mt-2">Add Color</button>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="button" class="removeRowButton btn btn-danger mt-2">Remove Size</button>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" id="addSizeColorButton" class="btn btn-primary mt-3">Add Size and Color</button>
                                    </div>

                                    <hr>
                                    <button type="submit" class="btn btn-success" style="margin-top: 20px;">Add Product</button>
                                </form>

    


                                <?php }?>
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


    <script>
        
    $(document).ready(function() {
        $('#categorySelect').change(function() {
            var category_id = $(this).val(); // Get the selected category ID
            $.ajax({
                type: 'POST',
                url: 'get_subcategories.php',
                data: { category_id: category_id },
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
        $('#productForm').submit(function(event) {
            // Prevent form submission
            event.preventDefault();
            
            // Check if the selected value is the default ("Choose Category")
            var category_id = $('#categorySelect').val();
            if (category_id === "") {
                // Show an error message or take other action (e.g., highlight the select box)
                alert('Please select a category.');
                return false; // Prevent form submission
            }
        });
    });

    </script>

       
<?php
    include_once 'layouts/footer.php';
?>