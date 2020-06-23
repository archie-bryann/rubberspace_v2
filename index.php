<?php
    include ('head.php');
    include ('redirect/logged_in.php');
    include 'includes/nav.inc.php';
?>  
<div id="preloader"></div>




                    <br>
                    <br>
                    <br>

    
  <div class = "container col-11">

 <!-- 
     search......
  -->




  <!-- 
      end...
   -->

  <div class="jumbotron">
  <h1>Welcome to <?php echo name; ?></h1>
  <p class="lead">Store, manage and share your files</p>
  <hr class="my-4">
  <p>We provide unlimited storage capacity for your files.</p>
  <p class="lead">
    <a class="btn <?php echo button1; ?> btn-lg animated rubberBand" href="<?php echo ROOT_URL.'signup'; ?>" role="button">Get Started</a>
  </p>
</div>
</div>

<br>

<div class="container center col-10">
<div class="row">

    <div class="col-sm-4">     
        <!-- <figure class = "filter-lofi"> -->
        <img src="img/2.jpg" class="responsive-img">
        <!-- </figure> -->
        <h2>Upload</h2>
        <p>Upload your files</p> 
    </div>

    <div class="col-sm-4">     
        <figure class = "filter-aden">     
        <img src="img/8.jpg" class="responsive-img img-thumbnail"> 
        </figure>
        <h2>Manage</h2>
        <p>Access, download, archive, privatize, or delete your files</p>     
    </div>
    
    <div class="col-sm-4">   
        <!-- <figure class = "filter-aden"> -->
        <img src="img/3.jpg" class="responsive-img"> 
        <!-- </figure> -->
        <h2>Share and Connect</h2>
        <p>Share your files and connect with millions of users</p>    
    </div>

    
    </div>
    </div>


<br>
<br>
<!-- preloader -->


 <?php
    include ('foot.php');
 ?>
