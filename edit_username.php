<?php
    include ('head.php');
    include ('redirect/not_logged_in.php');
    include 'includes/nav2.inc.php';

    $user = new UsersDisplay($_SESSION['id']);

?>




<br>
<br>
<br>

<div class="container col-lg-4 col-md-7 col-sm-8">
<legend><h1 align = "center">Edit Username</h1></legend><br>
    <div class="jumbotron">
<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
<?php


    if(isset($_POST['submit'])) {
    if(hash_equals($_SESSION['token'], $_POST['token'])) {
       
        $uid = $_POST['uid'];
        $id = $_SESSION['id'];

        $edit_username = new UsersContr();
        echo '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button><i class = "material-icons left">error</i> '.$edit_username->changeUsername($uid, $id).'</div>';

    } else {
        header("Location: 404");    
    }
 }

?>


<div class="form-group">
      <label for="uid">Username</label>
      <input required name = "uid" type="text" class="form-control" id="uid" aria-describedby="emailHelp" placeholder="Enter username" value = "<?php echo $user->displayUsername(); ?>">
</div>

<input type = "hidden" name = "token" value = "<?php echo $token; ?>"/>

<button name = "submit" type="submit" class="btn <?php echo button1; ?> btn-lg btn-block">Save</button>


</form>


<?php 
    if(!isset($_SESSION['id'])) {
        echo '<br><a class = "nav-link" href="login">Retry Login?</a>';
    } 
?>

</div>
</div>





           
               <br>
               <br>
<?php
    include ('foot.php');
?>


