<?php

    session_start();

    // correct later
    date_default_timezone_set('Africa/Lagos');
    date_default_timezone_get();    
    

    include ('classes/headerClass.class.php');

    
    // for my variables
    $dir = new Dbh();
    // $dir->connect();
    $dir->setVariable();    

    
    // For Colour
    $colour = new UsersContr();
    if(!isset($_SESSION['id'])) {
         $colour->setDefaultColour();
    } else {
         $colour->chooseColour($_SESSION['id']);
    }

    // CSRF Token
    if(empty($_SESSION['token'])) {
        $_SESSION['token'] = (bin2hex(random_bytes(32)));       
    }
    $token = $_SESSION['token'];

    $url = new AngelContr();
    $url->catchUrl();

    $ipStore = new UsersContr();
    $ipStore->storeIp();



?>