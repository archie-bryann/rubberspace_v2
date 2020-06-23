<?php
    include 'headerInc.php';

    $uploadNewCount = $_POST['uploadNewCount'];
    $tag = $_POST['tag'];

    $more = new UploadsView();
    $more->displayProfilePageUploads($tag, $uploadNewCount);
?>