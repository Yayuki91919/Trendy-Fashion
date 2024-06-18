 
<?php
    include_once 'layouts/header.php';
    include_once __DIR__. '../controller/typeController.php';

    $type_controller = new TypeController;


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
                                <p>Enter Product Type Name</p>        
                                <form action="process_form.php" method="post" id="productForm">
                                    <div class="form-group">
                                        <label for="name">Product Name:</label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter product name"
                                            style="width: 100%;" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="des">Description:</label>
                                        <input type="text" id="des" name="des" class="form-control" placeholder="Enter description"
                                            style="width: 100%;" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price:</label>
                                        <input type="text" id="price" name="price" class="form-control" placeholder="Enter price"
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
        <script>
        function previewImages(event) {
            var input = event.target;
            var previewContainer = document.getElementById('previewContainer');
            previewContainer.innerHTML = ''; // Clear previous previews

            var files = input.files;
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();

                reader.onload = function(e) {
                    var image = document.createElement('img');
                    image.style.maxWidth = '150px';
                    image.style.maxHeight = '150px';
                    image.style.margin = '5px';
                    image.src = e.target.result;
                    previewContainer.appendChild(image);
                };

                reader.readAsDataURL(file);
            }
        }
    </script>
<?php
    include_once 'layouts/footer.php';
?>