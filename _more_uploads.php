<?php
    include 'headerInc.php';

    $uploadNewCount = $_POST['uploadNewCount'];

    $more = new UploadsView();
    $more->displayUploads($_SESSION['id'], $uploadNewCount);
?>