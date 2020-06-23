<?php
// Tell them that they upload a book of any type     
    include ('head.php');
    include ('redirect/not_logged_in.php');
        
    include 'includes/nav2.inc.php';

    // echo '<h1>Edit Profile</h1>';

    $user = new UsersDisplay($_SESSION['id']);

?>




<br>
<br>






<div class="container col-lg-5 col-md-7 col-sm-7">
<legend><h2 align = "center">Edit Profile</h2></legend><br>
<a style = "float:right;" href = "whatsapp://send?text=<?=ROOT_URL.'profilepage?tag='.$_SESSION['id'];?>" class = "btn <?=upload;?>"><i class = "fab fa-whatsapp"></i> Share My Link</a>
    <div class="jumbotron">
    <span id = "status"></span>



<div>



<form class = "quote" method = "POST" action = "<?php echo $_SERVER['PHP_SELF']; ?>">


<?php
    include_once 'alertMsg/editProfileCheck.php';


if(isset($_POST['submit'])){
    if(hash_equals($_SESSION['token'], $_POST['token'])) {

        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $telephone = $_POST['telephone'];
        $about_me = $_POST['about_me'];

     
        if(isset($_POST['allowTelephone'])) {
              $allowTelephone = $_POST['allowTelephone'];
              
              if($allowTelephone == 'on') {
                  $allowTelephone = 1;
              } 
        } else {
            $allowTelephone = 0;
        }

        if(isset($_POST['allowEmail'])) {
                $allowEmail = $_POST['allowEmail'];

            if($allowEmail == 'on'){
                 $allowEmail = 1;
            }
        } else {
            $allowEmail = 0;    
        }
        $user_id = $_POST['user_id'];



        $update = new UsersContr();
        echo $update->updateProfile($firstname, $lastname, $telephone, $about_me, $allowTelephone, $allowEmail, $user_id);

        

        

    } else {
        header("Location: ".ROOT_URL."");
    }
    }      
?>



<div class="form-group">
<label for="firstname">Firstname</label>
<input required name = "firstname" type="text" class="form-control" id="firstname" aria-describedby="emailHelp" placeholder="Enter firstname" value = "<?php echo $user->displayFirst();?>">
</div>






<input name = "user_id" value = "<?php echo $_SESSION['id']; ?>" hidden>


<div class="form-group">
<label for="lastname">Lastname</label>
<input required name = "lastname" type="text" class="form-control" id="lastname" aria-describedby="emailHelp" placeholder="Enter lastname" value = "<?php echo $user->displayLast();
?>">
</div>


<div class="form-group">
      <label for="username">Telephone</label>
      <input name = "telephone" type="text" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Enter telephone" value = "<?php echo $user->displayTelephone();?>">
</div>

<input type = "hidden" name = "token" value = "<?php echo $token; ?>"/>


<div class="form-group">
      <label for="about_me">About Me</label>
      <textarea placeholder = "Tell people something about yourself..." id = "about_me" name = "about_me" class="form-control" id="about_me" rows="3" style="margin-top: 0px; margin-bottom: 0px; height: 98px;"><?php echo $user->displayAbout();?></textarea>
    </div>

<div>


<div class="form-check">
<label class="form-check-label" for="allowTelephone">
<input class = "form-check-input" id = "allowTelephone" name = "allowTelephone" type = "checkbox" <?php
    if($user->displayAllowTelephone() == 1) {
        echo 'checked>';
    } else  {
        echo '>';
    }
?>
Allow people to see my telephone
</label>
</div>


<div class="form-check">
<label class="form-check-label" for="allowEmail">
<input class = "form-check-input" id = "allowEmail" name = "allowEmail" type = "checkbox" <?php
    if($user->displayAllowEmail() == 1) {
        echo 'checked>';
    } else {
        echo '>';
    }
?>
Allow people to see my e-mail address
</label>
</div>

<br>
<button name = "submit" type = "submit" class="btn <?php echo button1;  ?> btn-lg btn-block" onclick = "uploadFile()">Save & Exit</button><br><br>


</form>


    


<?php
    $updated = $user->displayUpdated();
    if(empty($updated)) {
    } else {
        echo '<p><b>Last updated</b>: '.$user->displayUpdated().'</p>';

    }
?>
</div>
</div>








   



<?php
    include ('foot.php');
?>

