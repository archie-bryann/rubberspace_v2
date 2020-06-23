<?php
    include ('head.php');
    include ('redirect/not_logged_in.php');

    include 'includes/nav2.inc.php';


    
?>




<br>
<br>


    <div class="container col-lg-4 col-md-7 col-sm-8">
        <legend><h2 align = "center">Settings</h2></legend><br>
        <div class="jumbotron">

        <a id = "ebook" href="<?php echo ROOT_URL.'toggle_colour'; ?>"><li class="list-group-item">
            Toggle colour theme
            </li></a> 
            
            <br>

            <a id = "ebook" href="<?php echo ROOT_URL.'edit_username'; ?>"><li class="list-group-item">
            Edit username
            </li></a> 

            <br>

            <a id = "ebook" href="<?php echo ROOT_URL.'edit_email'; ?>"><li class="list-group-item">
            Edit email
            </li></a> 

            <br>

        <a id = "ebook" href="<?php echo ROOT_URL.'reset_password'; ?>"><li class="list-group-item">
            Reset my password
            </li></a> 

            <br>  

                <a id = "ebook" class = "modal-trigger" href="#modal1">
                <li class="list-group-item">
                Delete my account</li></a>
                <br>

                
           
        </div>

    </div>

    

  <!-- Modal Trigger -->
  <!-- <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a> -->

  <!-- Modal Structure -->
  <!-- <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Modal Header</h4>
      <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div> -->

  <div class="modal" id = "modal1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <a href = "#!" class = "btn btn-secondary"><span id = "close" aria-hidden="true">&times;</span></a>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete your account?</p>
      </div>
      <div class="modal-footer">
        <a class="btn btn-danger" href = "erase">Delete</button>
        <a href = "settings" class="btn btn-secondary" data-dismiss="modal"><span id="close">Cancel</span></a>
      </div>
    </div>
  </div>
</div>
<!-- use $_SESSION['id] -->







   



<?php
    include ('foot.php');
?>


<?php

if(isset($_GET['new_uid'])) {
  echo '
  <script>
    var toastHTML = "<span>You have successfully changed your username!</span>";
    M.toast({html: toastHTML});
    </script>';
}

?>
