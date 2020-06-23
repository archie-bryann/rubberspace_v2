<?php
// Tell them that they upload a book of any type     
    include ('head.php');
    include ('redirect/not_logged_in.php');
        
    include 'includes/nav2.inc.php';

    echo '<br><br>';


        $objDis = new UsersDisplay($_SESSION['id']);
 ?>  

<br>





    <div class="container col-lg-4 col-md-7 col-sm-8">
        <legend><h2 align = "center"> Upload something</h2></legend><br>
        <div class="jumbotron">

      
    <form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
    <?php

    if(isset($_POST['submit'])) {
    if(isset($_SESSION['id'])){    


    if(hash_equals($_SESSION['token'], $_POST['token'])) {   
    

    $file = $_FILES['userfile'];
    $fileName = $_FILES['userfile']['name'];
    
    if(isset($_POST['option'])) {
        $option = $_POST['option'];
    } else {
        header("dashboard.php?error");
    }
    
    if(isset($_POST['description'])) {
        $description = $_POST['description'];
    }
    
    
    
    $newObj = new UsersContr();
    echo '<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button><i class = "material-icons left">error</i> '.$newObj->uploadBook($file, $option, $description).'</div>';
    
} else {
    session_unset();
    session_destroy();
    header("Location: ".ROOT_URL."");
}
    

} else {
    header("Location: ".ROOT_URL."");
}

    }


if(isset($_GET['uploaded']) && isset($_GET['pc_CODE'])) {
    echo '<div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button><i class = "material-icons left">check</i> <b>The file has been successfully uploaded.</b>';
    if(isset($_GET['pc_CODE'])) {
        $code = $_GET['pc_CODE'];
        // echo ' The search code is '.$code.'.';
        echo ' <a class = "alert-link" href = "whatsapp://send?text=My%20e-book%20code%20is%20'.$code.'.%20Log%20on%20to'.ROOT_URL.'%20and%20do%20a%20search%20the%20code.">Share on whatsapp.</a></div>';  
    }
}

?>

<span id="status"></span>



<div  class="form-group">
      <label for="file"><b>Choose file</b>   <small  style = "color:<?=text;?>;">(You can upload multiple files)</small></label>
      <input required type="file" name = "userfile[]" value = "" multiple = "" class="form-control-file" id="file" aria-describedby="fileHelp">
    </div>


<input type = "hidden" name = "token" value = "<?php echo $token; ?>"/>






<div class="form-group">
<span><b>I want to make it</b></span>  <br />
<input required id = "private" name = "option" value = "private" type="radio"> <label for="private">Private</label> 
<input required id = "public" name = "option" value = "public" type="radio"> <label for="public">Public</label>
</div>



<div class="form-group">
<label for="description"><b>Description</b> <small style = "color:<?=text;?>;">(optional)</small></label>
<input name = "description" id = "description" type="text" placeholder = "Add a description..." class = "form-control">
<!-- <textarea placeholder = "Add a description..." class = "form-control" name="description" id="description" style="margin-top: 0px; margin-bottom: 0px; height: 98px;"></textarea> -->
</div>

<input type = "text" name = "user_id" value = "<?php echo $_SESSION['id']; ?>" hidden> 


<button name = "submit" type="submit" class="btn <?php echo button1; ?> btn-lg btn-block" onclick = "uploadFile()">Upload</button>
</form>


<br>
<!-- <br> -->
<a class = "nav-links" href = "<?php echo ROOT_URL.'documentation'; ?>">Do you need some help?</a>


</div>
    </div>



  



<?php
    include ('foot.php');
?>

