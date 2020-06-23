<?php

    include 'headerInc.php';

        if(isset($_POST['limit'], $_POST['start'])) {
            $request = new UploadsView();
            $request->testDisplayUploads($_SESSION['id'], $_POST['start'], $_POST['limit']);
        }
?>

    