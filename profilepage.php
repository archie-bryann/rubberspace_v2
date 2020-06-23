<?php
// Tell them that they upload a book of any type     
    include ('head.php');
    include ('redirect/not_logged_in.php');

    // Check for valid user
    include 'redirect/checkProfile.php';
    
 

        
    include 'includes/nav2.inc.php';


    $user = new UsersDisplay($_GET['tag']);

    $uploads = new UploadsView();

    // redirect profile_user to edit

    include 'redirect/denyUserProfile.php';  


        echo '<br>';
        echo '<br>';

  
        echo '<div class = "row">';
        echo '<div class="left container col-lg-4 col-md-7 col-sm-8">';
        echo '<br>';

          echo '<div class="card mb-3">';
        
        echo '
       <h3 class="card-header">About Me</h3>';
        ?>

        <?php

    
        echo '
        <ul class="list-group list-group-flush">
        <li class="list-group-item">';
        
        if(!empty($user->displayName())) {
          echo'</li>
          <li class="list-group-item">';
             echo '<b>Name:</b> '.$user->displayName();
             echo '</li>';
    }
        
      echo'</li>
      <li class="list-group-item">';
         echo '<b>Username:</b> '.$user->displayUsername();
         echo '</li>';
    

        if($user->displayAllowTelephone() == 1) {
            if(!empty($user->displayTelephone())) {
              echo'</li>
      <li class="list-group-item">';
            echo '<b>Telephone:</b> '.$user->displayTelephone();
         echo '</li>';
            }
            } 
         if($user->displayAllowEmail() == 1) {
            if(!empty($user->displayEmail())) {
              echo'</li>
              <li class="list-group-item">';
                 echo '<b>Email:</b> '.$user->displayEmail();
                 echo '</li>';
            }  
        }

         
         


        

    echo '</li>';

      if(!empty($user->displayAbout())) {
        echo'</li>
        <li class="list-group-item">';
           echo '<b>About:</b> '.$user->displayAbout();
           echo '</li>';
  }

   
   


  

echo '</li>';

        



       echo '</ul>
       <div class="card-footer text-muted">
         '.name.'
       </div>
     </div>
     </div>
     ';

     

    
        // For Uploads
        echo '<br><div  class = "container col-lg-8 col-md-6 col-sm-6 right">
                <h1 align = "center">'; if($uploads->countVisibleUploads($_GET['tag']) == '0') {
                  echo 'No uploads<style>#more_uploads{display:none;}</style>';
                } elseif($uploads->countVisibleUploads($_GET['tag']) == 1) { 
                  echo $uploads->countVisibleUploads($_GET['tag']).' upload</h1><br>';
                } else {
                  echo $uploads->countVisibleUploads($_GET['tag']).' uploads</h1><br>';
                }
             
                
                echo '<div id = "uploads">';
                $uploads->displayProfilePageUploads($_GET['tag'], 10);
                echo '</div>';
                ?>
                <button style = "margin-left:22px;" id = "more_uploads" class = "btn btn-block <?=buttonData;?>" id  = "moreuploads">See more</button>   
                <?php

        echo '
        
        </div>

        </div>

        <style>
        .row {
          padding: 30px;
        }
        </style>
        <div id = "load_data_message" style = "margin-top: -3%;" class = "container col-lg-8 col-md-3 col-sm-12 right"></div>
        
        ';





     echo '<br>';
     echo '<br>';
     echo '<br>';



    include ('foot.php');

  // // assign the tag parameter to a variable
?>

<script>
    $(function() {
        var uploadCount = 10;
        var tag = <?=$_GET['tag'];?>;
        $("#more_uploads").click(function() {
            uploadCount = uploadCount + 10
            $("#uploads").load("_more_profile_uploads.php", {
                uploadNewCount : uploadCount,
                tag : tag
            })
        })
    })
</script>


