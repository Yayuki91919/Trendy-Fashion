<?php
if(!isset($_SESSION)){ session_start();}
if(isset($_SESSION['error'])){
    ?>
    <div class="alert alert-danger">
        <?php echo $_SESSION['error'] ?>
    </div>
    <?php
}
unset($_SESSION['error']);

if(isset($_SESSION['info'])){
    ?>
    <div class="alert alert-success">
        <?php echo $_SESSION['info'] ?>
    </div>
    <?php
}
unset($_SESSION['info']);

?>