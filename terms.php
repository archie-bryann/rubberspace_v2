<?php
    include 'head.php';

    if(isset($_SESSION['id'])) {
        include 'includes/nav2.inc.php';    
    } else {
        include 'includes/nav.inc.php';
    }
                ?>
<br>
<br>
                
    <div class="container col-lg-4 col-md-7 col-sm-8">
        <legend><h2 align = "center">Terms & Privacy</h2></legend><br>
        <div class="jumbotron">

        <a id = "ebook" href="<?php echo ROOT_URL.'privacy_policy'; ?>"><li class="list-group-item">
            Privacy Policy
            </li></a> 
            
            <br>

            <a id = "ebook" href="<?php echo ROOT_URL.'terms_of_service'; ?>"><li class="list-group-item">
            Terms of Service
            </li></a> 

            <br>

            <a id = "ebook" href="<?php echo ROOT_URL.'terms_of_use'; ?>"><li class="list-group-item">
            Terms of Use
            </li></a> 

        </div>

    </div>
      
      <br>
      <br>
    
<?php
    include ('foot.php');
?>