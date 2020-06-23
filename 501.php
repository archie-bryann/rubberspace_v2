<?php
    include ('head.php');

    if(isset($_SESSION['id'])) {
        include 'includes/nav2.inc.php';
    } else {
        include 'includes/nav.inc.php';
    }
?>

    





<div class = "container center">
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<h1>501: Not Implemented</h1>
<a href = "<?php echo ROOT_URL; ?>" style = "text-decoration:none;"><h2>Back to Home</h2></a>
</div>


   
<br>
<br>


<?php
    include ('foot.php');
?>

