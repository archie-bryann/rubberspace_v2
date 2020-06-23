<?php
    include ('head.php');
    include ('redirect/logged_in.php');


    // Verify page Check
    include ('redirect/verifyCheck.php');
    
    
    include 'includes/nav.inc.php';
?>

<br>
<br>
<br>



<div class="container col-lg-4 col-md-4 col-sm-8">
<legend><h1 align = "center">Verify your email <i class="material-icons">verified_user</i></h1></legend><br>
<div class="jumbotron">
<form action = "<?php echo $_SERVER['REQUEST_URI']; ?>" method = "POST">
<?php
    if(isset($_POST['submit'])) {
        if(hash_equals($_SESSION['token'], $_POST['token'])) {
                $email = $_GET['email'];
                $code = $_POST['code'];           
    
                $verify = new UsersContr();
                echo '<div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button><i class = "material-icons left">error</i> '.$verify->validateUser($email, $code).'</div>';
        } else {
            header("Location: 404");
        }
    }
?>

<!-- <input name = "code" type="text" placeholder = "Enter Code"> -->


<div class="form-group">
      <label for="code">Code</label>
      <input required name = "code" type="text" class="form-control" id="code" aria-describedby="emailHelp" placeholder="Enter code">
      <small id="fileHelp" class="form-text text-muted">A verification code has been sent to your email. Check your spam folder if not found in inbox.</small>

    </div>


<input type = "hidden" name = "token" value = "<?php echo $token; ?>"/>
<button name = "submit" type="submit" class="btn <?php echo button1; ?> btn-lg btn-block">Verify</button>

</form>


<br>
<a class = "nav-link" href="<?php echo ROOT_URL.'resend?email='.htmlspecialchars($_GET['email']); ?>">Resend code</a>
</div>
</div>

<br>

<?php
    include ('foot.php');
?>