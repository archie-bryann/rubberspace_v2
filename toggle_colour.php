<?php
    include 'headerInc.php';
    
    // check the visibility and do the opposite of what is done
    $visible = new UsersContr();
    $visible->checkColour($_SESSION['id']);
    header("Location: settings");
?>





