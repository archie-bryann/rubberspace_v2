<?php
// Tell them that they upload a book of any type     
    include 'head.php';
    include 'redirect/not_logged_in.php';
    include 'includes/nav2.inc.php';
    // validate the url
    // include 'redirect/uploadCheck.php'; // redirect to 404 page
    $details = new UpdateFile($_GET['rc_CODE']);
?>
    <br>
    <br>
<div class = "container col-lg-4 col-md-7 col-sm-8">
<legend><h1 align = "center">Update Details</h1></legend><br>
<div class = "jumbotron">
<span id="status"></span>
<form action = "<?=ROOT_URL;?>update?rc_CODE=<?=$_GET['rc_CODE'];?>&up_id=<?=$_SESSION['id'];?>" method = "POST">
    <p class ="lead">Details of <i class = "truncate"><b>'<?php echo $details->file_name(); ?>'</b></i></p>

    <input type = "hidden" name = "token" value = "<?php echo $token; ?>"/>
      <?php
    if(isset($_POST['submit'])) {
    if(isset($_SESSION['id'])){    

    if(hash_equals($_SESSION['token'], $_POST['token'])) {   
    $file_name = $_POST['file_name'];
    $description = $_POST['description'];
    $code = $_POST['code'];
    $user_id = $_POST['user_id'];
    $newObj = new UsersContr();
    echo $newObj->updateBookDetails($file_name, $description, $code, $user_id);
} else {
    session_unset();
    session_destroy();
    header("Location: ".ROOT_URL."");
}
} else {
    header("Location: ".ROOT_URL."");
}
    }
    include 'alertMsg/updateCheck.php';
?>
   <div class="form-group">
      <label for="book_name">Name of file</label>
      <input required name = "file_name" type="text" class="form-control" id="book_name" aria-describedby="emailHelp" placeholder="Enter author of ebook" value = "<?php echo $details->file_name(); ?>">
    </div>

<div class="form-group">
      <label for="course">Description</label>
      <input name = "description" type="text" class="form-control" id="course"  placeholder="Enter description" value = "<?php 
   echo $details->description();
   ?>">
    </div>

<input type = "text" name = "code" value = "<?php
echo $details->code();
?>" hidden>
<input type = "text" name = "user_id" value = "<?php echo $_SESSION['id']; ?>" hidden> 
<br>

<button name = "submit" type="submit" class="btn <?php echo button1; ?> btn-lg btn-block" onclick = "uploadFile()">Save & Exit</button>
<?php
        if(!empty($details->updated())) {
            ?>
                <br><p class="lead"><small><b>Last Updated:</b> <?=$details->updated();?></small></p>
            <?php
        }
    ?>
</form>
</div>
</div>   

<?php
    include ('foot.php');
?>

