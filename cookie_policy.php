<?php
    echo '<title>Cookie Policy</title>';
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

                <div class="container col-lg-6 col-md-7 col-sm-8">
                    
                   
                    <!-- <h1>File extensions allowed for upload</h1> -->
                    <legend><h1 align = "center">Cookie Policy</h1></legend><br>  
                    
                    <h3 align = "center"><?php
                        echo DateView::updatedDate();
                    ?></h3><br>  

                    <div class="jumbotron"> 
                    <h2>Statement 1</h2>
                   Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio autem rerum aliquid provident est, quidem nobis. Earum omnis atque, possimus error sint suscipit laudantium voluptatem repudiandae odio recusandae adipisci repellat explicabo! Molestiae accusamus adipisci amet cum quibusdam! Soluta esse sint adipisci alias? Vero dolores eligendi amet iste, consequuntur dicta. Accusamus nulla qui inventore, minima velit deserunt facilis voluptatibus, nisi quis, nobis placeat nam! Repellendus ipsam voluptas enim sint alias beatae, neque excepturi sit pariatur sed et ea laborum! Nam accusamus, veritatis quaerat quasi recusandae adipisci laudantium sint officia aliquid placeat sapiente sunt molestias voluptas vel minus ex corrupti cupiditate necessitatibus. </div>
                    </div>
                


                  
      
                    <br>
     
    
<?php
    include ('foot.php');
?>