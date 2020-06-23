<?php
    include 'headerInc.php';
    // check the visibility and do the opposite of what is done
    $delete = new UsersContr();
    $delete->performDeletion($_SESSION['id']);
?>





