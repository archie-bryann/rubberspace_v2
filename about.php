<?php
    include 'head.php';
?>
            
                <?php
                    if(isset($_SESSION['id'])) {
                        include 'includes/nav2.inc.php';    
                    } else {
                        include 'includes/nav.inc.php';
                    }
                ?>


                <br>
                <br>
                    <br>

             
              <div class="container col-lg-7 col-md-7 col-sm-8">
            <legend><h2 align = "center">About</h2></legend><br>
                <div class="jumbotron">
              <h3>About <?php echo name; ?></h3>
              <p>RubberSpace is an internet platform for uploading, managing and sharing your files with people. The platform also provides unlimited storage capacity to users.</p>
                </div>
              <br>

              <div class="jumbotron">
              <h3>About The Team</h3>
              Ekomobong Archibong is the inventor and founder of RubberSpace.
              <br>
              Nwaeke Daniel Chijindu is a founder of RubberSpace.
              </div>

 

              <br>
        

<?php
    include ('foot.php');
?>