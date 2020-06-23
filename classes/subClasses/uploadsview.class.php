<?php

class UploadsView extends Users {



public function countUploads($id) {
$stmt = $this->checkUploads($id);
$check = $stmt->fetchAll();
return count($check);
}

public function countVisibleUploads($id) {
$stmt = $this->checkVisibleUploads($id);  // and notAnonymous Uploads
$check = $stmt->fetchAll();
return count($check);
}


public function displayUploads($id, $limit) {

$results = $this->fetchUploads($id, $limit);

while($row = $results->fetch()) {
?>
    <ul class="collapsible">
        <li class="lead" id="sub">
            
            <div class="collapsible-header">
                <b class =  "truncate"><?=$row['file_name'];?></b>
                <?php
                    if($row['visible'] == 0) {
                        echo '<i class = "tiny material-icons right tooltipped" data-position = "top" data-tooltip = "Private">person</i>';
                    }
                ?>
            </div>
            <div class="collapsible-body">
                <b>File ID:</b> <?=$row['code'];?>
                
                <?php
                    if(!empty($row['description'])) {
                        echo '<br>';
                    } else {
                        echo '<br><br>';
                    }


                    if(!empty($row['description'])) {
                        ?>
                            <b>Description:</b> <?=$row['description'];?><br><br>
                        <?php
                    }
                    $user = $this->checkUserId($row['user_id']);
                ?>
                
                <a href = "<?=$this->uploadLocation().$user[0]['folder_code'].'/'.$row['file_name'];?>" target = "_blank" class = "btn <?=buttonData;?>">Read</a>

                <!-- <a href = "<?=$this->uploadLocation().$user[0]['folder_code'].'/'.$row['file_name'];?>" target = "_blank" class = "btn <?=buttonData;?>">Read</a> -->


                <a href = "<?=$this->uploadLocation().$user[0]['folder_code'].'/'.$row['file_name'];?>" download = "<?=$row['file_name'];?>" class = "btn <?=buttonData;?>">Download</a>

<!-- 

                    Change Made:

 -->           
                 <!-- <input style = "width:6px;color:white;" type = "text" value = "<?=ROOT_URL.'search?q='.$row['code'].'';?>" id = "myInput_<?=$row['id'];?>"/>
                <div class = "tooltip_1">
                <button onClick = "myFunction_<?=$row['id'];?>()" onMouseOut = "outFunc_<?=$row['id'];?>()" class = "btn <?=buttonData;?>"><span class = "tooltiptext_1" id="myTooltip_<?=$row['id'];?>">Copy to Clipboard</span><i class="far fa-copy"></i> Copy</button>
                </div>
                <script>
                function myFunction_<?=$row['id'];?>() {
                    var id = <?php echo $row['id'];?>;
                    var copyText = document.getElementById("myInput_"+id);
                    console.log(copyText)
                    copyText.select();
                    copyText.setSelectionRange(0, 99999);
                    document.execCommand("copy");
                    
                    var tooltip = document.getElementById("myTooltip_"+id);
                    // tooltip.innerHTML = "Copied: " + copyText.value;
                    tooltip.innerHTML = "Link copied";
                }

                function outFunc_<?=$row['id'];?>() {
                    var tooltip = document.getElementById("myTooltip_"+id);
                    tooltip.innerHTML = "Copy to clipboard";
                }
                </script>
                <style>
                .tooltip_1 {
                position: relative;
                display: inline-block;
                }

                .tooltip_1 .tooltiptext_1 {
                visibility: hidden;
                width: 140px;
                background-color: #555;
                color: #fff;
                text-align: center;
                border-radius: 6px;
                padding: 5px;
                position: absolute;
                z-index: 1;
                bottom: 150%;
                left: 50%;
                margin-left: -75px;
                opacity: 0;
                transition: opacity 0.3s;
                }

                .tooltip_1 .tooltiptext_1::after {
                content: "";
                position: absolute;
                top: 100%;
                left: 50%;
                margin-left: -5px;
                border-width: 5px;
                border-style: solid;
                border-color: #555 transparent transparent transparent;
                }

                .tooltip_1:hover .tooltiptext_1 {
                visibility: visible;
                opacity: 1;
                }
                </style>
 -->

                <a href = "whatsapp://send?text=<?=ROOT_URL.'search?q='.$row['code'].'';?>" class = "btn <?=buttonData;?>"><i class = "fab fa-whatsapp"></i> Whatsapp</a>
<!-- 

                    Ends Here

 -->

                <a href = "<?=ROOT_URL.'update?rc_CODE='.$row['code'].'&up_id='.$row['user_id'];?>" class = "btn <?=buttonData;?>">Update</a> 


           

                <!-- <a title = "Share on whatsapp" href = "whatsapp://send?text=<?=ROOT_URL.'search?q='.$row['code'].'';?>" class = "btn <?=buttonData;?>"><i class="fab fa-whatsapp"></i></a></a> -->

               
               <?php
                    if($row['visible'] == 1) {
                        ?>
                <a href = "<?=ROOT_URL.'visibility.php?uc_CODE='.$row['code'];?>" class = "btn <?=buttonData;?>">Make private</a>  
                        <?php
                    } else {
                        ?>
                    <a href = "<?=ROOT_URL.'visibility.php?uc_CODE='.$row['code'];?>" class = "btn <?=buttonData;?>">Make public</a>
                        <?php
                    }
                ?>
                <a href = "<?=ROOT_URL.'delete.php?uc_CODE='.$row['code'];?>" class = "btn <?=button2;?>">Delete</a>
                
              
            </div>
        </li>
    </ul>  
    <script>
// collapsible
$(document).ready(function(){
    $(".collapsible").collapsible();
});
// tooltip
$(document).ready(function(){
    $(".tooltipped").tooltip();
    });
</script>

<?php
    }
}

public function displayProfilePageUploads($id, $limit) {

    $results = $this->fetchPublicUploadsOnly($id, $limit);

    while($row = $results->fetch()) {
    ?>
        <ul class="collapsible">
            <li class="lead" id="sub">
                
                <div class="collapsible-header">
                    <b class =  "truncate"><?=$row['file_name'];?></b>
                    <?php
                        if($row['visible'] == 0) {
                            echo '<i class = "tiny material-icons right tooltipped" data-position = "top" data-tooltip = "Private">person</i>';
                        }
                    ?>
                </div>
                <div class="collapsible-body">
                <b>File ID:</b> <?=$row['code'];?>
                
                <?php
                    if(!empty($row['description'])) {
                        echo '<br>';
                    } else {
                        echo '<br><br>';
                    }


                    if(!empty($row['description'])) {
                        ?>
                            <b>Description:</b> <?=$row['description'];?><br><br>
                        <?php
                    }
                    $user = $this->checkUserId($row['user_id']);

                ?>
                    
                    <a href = "<?=$this->uploadLocation().$user[0]['folder_code'].'/'.$row['file_name'];?>" target = "_blank" class = "btn <?=buttonData;?>">Read</a>
                    <a href = "<?=$this->uploadLocation().$user[0]['folder_code'].'/'.$row['file_name'];?>" download = "<?=$row['file_name'];?>" class = "btn <?=buttonData;?>">Download</a>
    
                    
                    <a href = "whatsapp://send?text=<?=ROOT_URL.'search?q='.$row['code'].'';?>" class = "btn <?=buttonData;?>"><i class = "tiny material-icons left">share</i> Share on whatsapp</a>
                   </div>
            </li>
        </ul>  
        <script>
    // collapsible
    $(document).ready(function(){
        $(".collapsible").collapsible();
    });
    // tooltip
    $(document).ready(function(){
        $(".tooltipped").tooltip();
        });
    </script>
    
    <?php
        }
    }

// public function TestDisplayProfilePageUploads($id, $start, $limit) {
// $result = $this->testCheckUploads($id, $start, $limit);

// while($row = mysqli_fetch_assoc($result)) {
//     if($row['visible'] == 1) {

//         if($row['uploaded_by'] !== 'Anonymous') {
//         echo '<ul class = "collapsible">
//         <li class = "lead" id = "sub">
//         <div class = "collapsible-header">';
//         echo '<b>'.$row['book_name'].' </b>';
//         echo '</div>';
        
//         echo '<div class ="collapsible-body">';
//         echo '<b>File Name</b>: '.$row['searchFileName'].'<br>';
//         echo '<b>Type</b>: '.$row['extension'].'<br>';

//         if(round($row['file_size']) == 0 ) {
//             echo '<b>Size</b>: '.round($row['file_size']*1000000).'B<br>';
//         } 
//         elseif(round($row['file_size'] < 2)) {
//             echo '<b>Size</b>: '.round($row['file_size']*1000).'KB<br>';                
//         } else {
//             echo '<b>Size</b>: '.round($row['file_size']).'MB<br>';
//         }

//         echo '<b>Author</b>: '.$row['book_author'].'<br>';
//         echo '<b>Code</b>: '.$row['code'].'<br>';
//         echo '<b>Course</b>: '.$row['course'].'<br>';

//         // link the user_id, not just the user_name, so when there is a change, it will reflect
//         $id = $row['user_id'];
//         $results = $this->checkId($id);
//         // if($row['uploaded_by'] !== 'Anonymous') {  // cheking if it's anonymous
//         //     echo '<b>Uploaded by</b>: <a id="ebook" href = "profilepage?tag='.$results[0]['id'].'">'.$results[0]['firstname']. ' '.$results[0]['lastname'].'</a><br>';
//         // } else  {
//         //     echo '<b>Uploaded by</b>: Anonymous<br>';
//         // }

//         echo '<b>Time</b>: '.$row['time'].'<br><br>';


//             if($row['extension'] !== 'zip') {
                        
//             if(isset($_SESSION['id'])) {
//                 echo '<a href = "'.$this->uploadLocation().$row['file_name'].'/'.$row['file_name'].'" target = "_blank" class = "btn '.buttonData.'">Read</a>   '; // only works for laptop
//             } else {
//                 echo '<a href = "'.ROOT_URL.'login" class = "btn '.buttonData.'">Read</a>   ';
//             }
//             }       


//         if(isset($_SESSION['id'])) {
//             echo '<a href = "'.$this->uploadLocation().$row['file_name'].'/'.$row['file_name'].'" download = "rubberspace_'.$row['file_name'].'" class = "btn '.buttonData.'">Download</a>   ';
//         } else {
//             echo '<a href = "'.ROOT_URL.'login" class = "btn '.buttonData.'">Download</a>   ';
                                    
//         }

//         echo '<a href = "whatsapp://send?text=Click%20the%20link%20below%20to%20download%20'.$row['book_name'].'.%0A%0A'.ROOT_URL.'search?q='.$row['code'].'" class = "btn btn-outline-success"><i class = "tiny material-icons left">share</i> Share on whatsapp</a> ';
//         echo '</div></li>
//         </ul>
        
//     <script src = "public/js/jquery-3.4.1.min.js"></script>
//     <script src = "public/js/materialize.min.js"></script>

//     <script src = "public/js/materialize.min.js"></script>

//         <script>
//         // collapsible
//         $(document).ready(function(){
//             $(".collapsible").collapsible();
//         });

//         // tooltip
//         $(document).ready(function(){
//             $(".tooltipped").tooltip();
//             });
        
//         </script>
//                             ';

//     }
//         }
// }
// }
}
