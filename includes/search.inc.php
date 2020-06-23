<form action = "search.php" method = "GET" class="form-inline my-2 my-lg-0">
<input class="form-control mr-sm-2" id = "q" required  name = "q" value = "<?php echo isset($_GET['q']) ? $_GET['q'] : ''; ?>" type ="text" placeholder = "Search">
<button class="btn <?php echo buttonSearch; ?> my-2 my-sm-0 animated rubberBand" name = "submit-search" type = "submit">Search</button> 
</form>


