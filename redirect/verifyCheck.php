<?php
    if(isset($_GET['email'])) {

        $check = new UsersContr();
        $results = $check->validateEmail($_GET['email']);
        
       if(empty($results)) {
            header("Location: 404");
       }

    // Redirect, if the user has been verifie
    if($results[0]['verified'] == 1) {
        header("Location: dashboard.php");
    }   
  

    } else {
        header("Location: 404");
    }
?>