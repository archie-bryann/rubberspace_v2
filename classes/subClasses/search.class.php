<?php

class Search extends Users {
    
    // 3 for each

    public function getUsers($search, $num) {


        if(strlen(trim($search)) > 0) { // if there are no words

            // users
            $userResults = $this->searchUsers($search, $num);

            ?>
            <ul class = "collapsible">
                    <li class = "lead" id = "sub">
                    <div class = "collapsible-header">
                        <h3>Users</h3>
                    </div>
                    </li>
                      <!-- </ul> -->
            <?php

            while($row = $userResults->fetch()) {
                ?>
                    <li class = "lead" id = "sub">
                    <div class = "collapsible-header">
                        <b><a href="profilepage?tag=<?=$row['id']?>"><u><?=$row['firstname'].' '.$row['lastname'];?></u></a></b>
                    </div>
                    </li>
                <?php
            }
           
        } else {
            ?>
                   <ul class = "collapsible">
                    <li class = "lead" id = "sub">
                    <div class = "collapsible-header">
                        <h3>No Search Results!</h3>
                    </div>
                    </li>
                      </ul>
            <?php
        }
    }

    public function getFiles($search, $num) {

        if(strlen(trim($search)) > 0) { // if there are no words
                    // files
                    $fileResults = $this->searchFiles($search, $num);

                    ?>
                        <ul class = "collapsible">
                            <li class = "lead" id = "sub">
                            <div class = "collapsible-header">
                                <h3>Files</h3>
                            </div>
                        
                            </li>
                              <!-- </ul> -->
                    <?php
        
                    while($row = $fileResults->fetch()) {

                        if($row['visible'] == 1) {
                                    ?>
        
                            <li class = "lead" id = "sub">
                            <div class = "collapsible-header">
                                <b><?=$row['file_name'];?></b>
                            </div>
                            <div class="collapsible-body">
                            <b>File ID:</b> <?=$row['code'];?>
                
                <?php
                    if(!empty($row['description'])) {
                        echo '<br>';
                    } else {
                        echo '<br>';
                    } ?>

                                <?php
                                if(!empty($row['description'])) {
                                    ?>
                                        <b>Description:</b> <?=$row['description'];?><br>
        
                                        <?php
                                }
                                $user = $this->checkUserId($row['user_id']);

                                ?>
                                        <b>Uploaded by: <?php
                                            if(isset($_SESSION['id'])) {
                                            if($_SESSION['id'] == $row['user_id']) {
                                                echo 'You';
                                            } else {
                                                echo '<a href = "profilepage?tag='.$user[0]['id'].'"><u>'.$user[0]['firstname'].'  '.$user[0]['lastname'].'</u></a>';
                                            }
                                        } else {
                                                echo '<a href = "profilepage?tag='.$user[0]['id'].'"><u>'.$user[0]['firstname'].'  '.$user[0]['lastname'].'</u></a>';
                                        }    
                                        ?></b>
                                        <br><br>


                                
                                <?php
                                    if(isset($_SESSION['id'])) {
                                        ?>
                                            <a href = "<?=$this->uploadLocation().$user[0]['folder_code'].'/'.$row['file_name'];?>" target = "_blank" class = "btn <?=buttonData;?>">Read</a>
                                            <a href = "<?=$this->uploadLocation().$user[0]['folder_code'].'/'.$row['file_name'];?>" download = "<?=$row['file_name'];?>" class = "btn <?=buttonData;?>">Download</a>
                                           
                                        <?php
                                    } else {
                                        ?>

                                            <a href = "login" class = "btn <?=buttonData;?>">Read</a>
                                            <a href = "login" class = "btn <?=buttonData;?>">Download</a>

                                        <?php
                                    }
                                ?>
                                
                                <a href = "whatsapp://send?text=<?=ROOT_URL.'search?q='.$row['code'].'';?>" class = "btn <?=buttonData;?>"><i class = "tiny material-icons left">share</i> Share on whatsapp</a>
        
                                <?php
                                    if(isset($_SESSION['id'])) {
                                        if($row['user_id'] == $_SESSION['id']) {
                                            ?>
                                            <a href = "<?=ROOT_URL.'update?rc_CODE='.$row['code'].'&up_id='.$row['user_id'];?>" class = "btn <?=buttonData;?>">Update</a> 
                                            <?php
                                        }
                                    }
                                   
                                ?>
        
                                <?php
                                    if(isset($_SESSION['id'])) {
                                    if($row['user_id'] == $_SESSION['id']) {
                                        ?>
                                         <a href = "<?=ROOT_URL.'delete.php?uc_CODE='.$row['code'];?>" class = "btn <?=button2;?>">Delete</a>
                                        <?php
                                    }
                                }
                                ?>
        
        
                                <!-- others -->
        
                            </div>
                            </li>

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
                } else {
                    ?>
                           <ul class = "collapsible">
                            <li class = "lead" id = "sub">
                            <div class = "collapsible-header">
                                <h3>No Search Results!</h3>
                            </div>
                            </li>
                              </ul>
                           
                 <?php
                }
    }
    
}