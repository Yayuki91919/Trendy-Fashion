<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['error'])) {
?>
    <!-- <div class="alert alert-danger">
        <?php //echo $_SESSION['error'] ?>
    </div> -->
    <div class="alertPart mt-50">
        <div class="alert alert-danger alert-common alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="tf-ion-close-circled"></i><span>Warning!</span> <?php echo $_SESSION['error'] ?>
        </div>
    </div>
<?php
}
unset($_SESSION['error']);

if (isset($_SESSION['info'])) {
?>
    <!-- <div class="alert alert-success">
        <?php // echo $_SESSION['info'] 
        ?>
    </div> -->
    <div class="alertPart mt-50">
        <div class="alert alert-success alert-common alert-dismissible " role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="tf-ion-thumbsup"></i><span>Well done!</span> <?php echo $_SESSION['info'] ?>
        </div>
    </div>
<?php
}
unset($_SESSION['info']);

?>