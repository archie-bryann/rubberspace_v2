<?php
    include ('head.php');
        
    if(isset($_SESSION['id'])) {
        include 'includes/nav2.inc.php';
    } else {
        include 'includes/nav.inc.php';
    }

    if(isset($_GET['submit-search'])) {
        header("Location: ".ROOT_URL."search?q=".$_GET['q']."");
    }

    echo '<br>';
    echo '<br>';
    echo '<br>';

    echo '<div class = "container col-lg-7 col-md-7 col-sm-7">';

    
    if(isset($_GET['q'])) {
    echo "<h3 align = 'center'>Search results for '". htmlspecialchars($_GET['q']) ."'</h3><br>";
    }

    if(isset($_GET['q'])) {
    $search = $_GET['q'];  

    $toSearch = new Search();

    ?>

    <div id="users">
        <?=$toSearch->getUsers($search, 3);?>
    </div>
    <br />
    <button id = "more_users" class = "btn btn-block <?=buttonData;?>">more users</button>


        <br>
    <div id="files">
    <?=$toSearch->getFiles($search, 3);?>
    </div>
    <br />
    <button id = "more_files" class = "btn btn-block <?=buttonData;?>">more files</button>


    <?php
    // $toSearch->get($search);

    }

    echo ' <style>
    @media(max-width: 575px) {
        .collapsible {
            margin-left: -8%;
        }
    }
</style> </div>';

    ?>

    



</div>


<!-- <div class="container col-lg-4 col-md-7 col-sm-8">
<legend><h2 align = "center">Search Results</h2></legend>
<ul class="collapsible">
    <li id = "sub">
      <div class="collapsible-header">The Green Book of Algebra    <a style = "margin-left:13px;" href="#!">Read </a> <span style = "margin-left:2px;">|</span><a style = "margin-left:2px;" href="#!"> Download</a></div>
      <div class="collapsible-body"><span><i class="material-icons left">details</i>Lorem ipsum dolor sit amet.</span></div>
    </li>
  </ul>
</div>
<br> -->




</body>
<br>
<br>
<br>
<br>
<?php
    include 'foot.php';
?>
<script>
$(function(){

    // for users
    var userCount = 3
    var q = $("#q").val()
    $("#more_users").click(function(){
        userCount = userCount + 8
        $("#users").load("_more_users.php", {
            userNewCount : userCount,
            q : q
        })
    })

    // for files
    var fileCount = 3
    var q = $("#q").val()
    $("#more_files").click(function(){
        fileCount = fileCount + 8
        $("#files").load("_more_files.php", {
            fileNewCount : fileCount,
            q : q
        })
    })
})
</script>