<?php

    include 'headerInc.php';

        if(isset($_POST['limit'], $_POST['start'])) {
            $request = new UploadsView();
            $request->testDisplayProfilePageUploads($_SESSION['tag'], $_POST['start'], $_POST['limit']);
        }
?>

    