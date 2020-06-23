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
<legend><h1 align = "center">Edit Email</h1></legend><br>
    <div class="jumbotron">
<form action = "<?php echo $_SERVER['PHP_SELF']; ?>" method = "POST">
<?php


    if(isset($_POST['submit'])) {
    if(hash_equals($_SESSION['token'], $_POST['token'])) {
       
        $email = $_POST['email'];
        $id = $_SESSION['id'];

        $edit_email = new UsersContr();
        echo '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button><i class = "material-icons left">error</i> '.$edit_email->changeEmail($email, $id).'</div>';

    } else {
        header("Location: 404");    
    }
 }

?>


<div class="form-group">
      <label for="uid">Email</label>
      <input required name = "email" type="text" class="form-control" id="uid" aria-describedby="emailHelp" placeholder="Enter email" value = "<?php echo $user->displayEmail(); ?>">
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


