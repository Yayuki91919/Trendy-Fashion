<?php
include('layouts/header.php');
include_once __DIR__. '../controller/collaborationController.php';
$collaboration_controller = new CollaborationController();
$collaboration = $collaboration_controller->getCollaboration();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $info = $_POST['content'];
    $id = 1; // Set the correct ID here

    $result = $collaboration_controller->editCollaboration($id, $info);
    if ($result) {
        $message = 2;
        echo '<script>location.href="collaboration.php?status='.$message.'"</script>';
    }
}
?>

<!-- Include Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
<!-- Content body start -->
<div class="content-body">
    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">Collaboration</a></li>
            </ol>
        </div>
    </div>
    <?php
            if (isset($_GET['status']) && $_GET['status'] == 2) {
                echo "<div class='alert alert-success text-success'> Collaboration Information Successfully Updated. </div>";
            }
    ?>
    <!-- row -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4>Write Your Collaboration Information</h4>
                        <div class="summernote" id="summernote">
                            <?php echo $collaboration['info']; ?>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-success btn-rounded w-25" id="saveBtn" type="button">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #/ container -->
</div>
<!-- Content body end -->

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Summernote JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>

<script>
$(document).ready(function() {
    $('#summernote').summernote({
        height: 300 // Set the height of the editor
    });

    $('#saveBtn').click(function() {
        var content = $('#summernote').summernote('code');

        // Perform basic validation
        if (content.trim() === '') {
            alert('Content cannot be empty');
            return;
        }

        $.ajax({
            url: '', // Submit to the same PHP file
            method: 'POST',
            data: { content: content },
            success: function(response) {
                // Assuming response is a success message or HTML content
                location.href = "collaboration.php?status=2";
            },
            error: function(xhr, status, error) {
                console.error(xhr);
            }
        });
    });
});
</script>

<?php include('layouts/footer.php'); ?>
