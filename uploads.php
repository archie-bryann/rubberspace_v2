<?php
// Tell them that they upload a book of any type     
    include ('head.php');
    include ('redirect/not_logged_in.php');
        
    include 'includes/nav2.inc.php';

    echo '<br><br><br>';

    $uploads = new UploadsView();

?>
 
<!-- -------------------  HERE HERE HERE ----------------- -----------------------  -->


<div id = "load_data"  class = "container col-lg-7 col-md-6 col-sm-6">
<?php 
echo '<h1 align = "center">My Uploads <small>';



    echo '('.$uploads->countUploads($_SESSION['id']).')';

    if($uploads->countUploads($_SESSION['id']) == 0) {
        echo '<style>#more_uploads{display:none;}</style>';
    } 
    
    
echo '</small></h1><a style = "float:right;" href = "whatsapp://send?text='.ROOT_URL.'profilepage?tag='.$_SESSION['id'].'" class = "btn '.buttonData.'"><i class = "fab fa-whatsapp"></i> Share My Link</a>';
?>
<br>


<!-- -------------------  HERE HERE HERE ----------------- -----------------------  -->

<div id="uploads">
<?php
    $uploads->displayUploads($_SESSION['id'], 10);
?>
</div>
<br />
<button  style = "margin-left:8px;" id = "more_uploads" class = "btn btn-block <?=buttonData;?>" id  = "moreuploads">See more</button> 
<?php
    if($uploads->countUploads($_SESSION['id']) == 0) {
        ?>
<a style = "margin-left:8px;" href = "dashboard" class = "btn btn-block <?=buttonData;?> btn-lg" id  = "moreuploads">Upload something</a> 

        <?php
    }
?>  
<style>
.truncate {
  display: block;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
</style>

     </div>  
     <!-- uncomment -->


<?php
    
    echo '<div class = "container col-lg-7 col-md-6 col-sm-6"><br><br>';
    include ('foot.php'); 
    echo '</div>';
?>

<script>
    $(function() {
        var uploadCount = 10;
        $("#more_uploads").click(function() {
            uploadCount = uploadCount + 10
            $("#uploads").load("_more_uploads.php", {
                uploadNewCount : uploadCount
            })
        })
    })
</script>