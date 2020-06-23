 <?php


// the controller
class UsersContr extends Users {

    public function jsRedirect($url) {
        echo '<script>window.location="'.$url.'";</script>';
    }
    
    public function setDefaultColour() {
        define('colour1', 'bg-dark');  
        define('upload', 'btn-success');
        define('button1', 'btn-outline-success'); 
        define('buttonData', 'btn-outline-success'); 
        define('button2', 'btn-outline-danger'); 
        define('buttonSearch', 'btn-outline-success');
        define('spinner1', 'text-success');  
        define('myBlack', '#555555');      
        define('text', 'green');
    }

    public function setWhiteColour() {
       define('colour1', 'bg-primary');
       define('upload', 'btn-primary');
       define('button1', 'btn-outline-info');
       define('buttonData', 'btn-primary');
       define('button2', 'btn-danger');
       define('buttonSearch', 'btn-outline-secondary');
       define('spinner1', 'text-info');
       define('myBlack', '#158cba');
       define('text', 'blue');
    }

    public function chooseColour($id) {
        $results = $this->checkId($id);

        if($results[0]['colour'] == 'light') {
            $this->setWhiteColour();
        } else {
            $this->setDefaultColour();
        }
    }

    // ---------------------------- COLOUR TOGGLE ---------------------------

    public function checkColour($id) {
        $results = $this->checkId($id);
        
        if($results[0]['colour'] == 'light') {
            $this->setDark($id);
        } else {
            $this->makeLight($id);
        }
    }
    
    public function setDark($id) {
        $this->makeDark($id);
    }

    public function setLight($id) {
        $this->makeLight($id);
    }   

    // ---------------------------------------------------------------------

    public function validateId($id) {
        return $this->checkId($id);
    }

    public function getUserIpAddr(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function storeIp() {
        
        $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $ip = $this->getUserIpAddr();

        if(isset($url)) {
        $results = $this->checkIp($ip);

        if(isset($results[0]['count'])) {
            // old users
            $new_count = $results[0]['count'] + 1;

            $this->updateCount($new_count, $ip);
        } else {
            // new_users
            $this->insertIp($ip);
            }
        }        
    }

    public function generateCode($num) {
        $keyLength = $num;
        $str = uniqid("0123456789");
        $randStr = substr(str_shuffle($str), 0, $keyLength);
        return $randStr;
    }

    public function makeMyFolder($num) {
        // check for similar code in DB
        $code = $this->generateCode($num);

        $checker = $this->checkFolderName($code);

        while($checker == true) {
            $code = $this->generateCode($num);
            $checker = $this->checkFolderName($code);
        }

        // make the folder
        mkdir('dir/'.$code);


        return $code;
    }

    public function checkFolderName($code) {
        $results = $this->fetchFolderCode($code);

        while($row = $results->fetch()) {
            if($row['folder_code'] == $code) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function getFileCode($num) {
        $code = $this->generateCode($num);

        $checker = $this->checkFileCode($code);
        
        while($checker == true) {
            $code = $this->generateCode($num);
            $checker = $this->checkFileCode($code);
        }

        return $code;

    }

    public function checkFileCode($code) {
        $results = $this->fetchFileCode($code);
        
        while($row = $results->fetch()) {
            if($row['code'] == $code) {
                return true;
            } else {
                return false;
            }
        }
        
    }


    public function createUser($firstname, $lastname, $email, $uid, $pwd) {
        $firstname = htmlspecialchars($firstname);
        $lastname = htmlspecialchars($lastname);
        $email = htmlspecialchars($email);
        $uid = htmlspecialchars($uid);
        $pwd = htmlspecialchars($pwd);

        if(empty($firstname) || empty($lastname) || empty($email) || empty($uid) || empty($pwd)) {
            return 'Please fill in all fields';            
        } else {
        $firstname = ucwords($firstname);
        $lastname = ucwords($lastname);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'You have used an invalid email!';
        } else {
                $results = $this->checkEmail($email);

                if(!empty($results)) {
                    return 'You have used an invalid email!';  
                } else {
                    if(stripos($uid, 'anonymous') !== false && strlen($uid) == strlen('anonymous')) {
                        return 'You have used an invalid username!';
                    } else {
                        $results = $this->checkUsername($uid);

                        if(!empty($results)) {
                            return 'You have used an invalid username!';
                        }  else {
                            if(strlen($pwd) < 6) {
                                return 'Password must be greater than 6 characters!  ';
                            } else {
                            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                            $time = date('M d, Y').' at '.date('h:ia');

                            
                            $ipaddress = $this->getUserIpAddr();

                            // create random folder
                            $folderCode = $this->makeMyFolder(11);

                            $fullname = $firstname . ' ' . $lastname;

                            $this->insertUser($firstname, $lastname, $fullname, $email, $uid, $hashedPwd, $pwd, $ipaddress, $time, $folderCode);

                            $this->sendCode($email);
                            header("Location: verify?email=".$email."");
                            }
                        }
                    }                    
                }
            }
        }
    }


    
    public function sendCode($email) {
        $code = $this->generateCode(5);

        // store the code in db
        $this->backupCode($code, $email);

        // ----------- Email -------------------
        
        $name = "RubberSpace";
        $subject = "E-mail Verification";
        $mailFrom = "rubberspace.space@gmail.com";
        $message = "The verification code for your RubberSpace account - ".$code."";

        $mailTo = $email;
        $headers = "From: ".$mailFrom;
        $txt = "You have received an e-mail from ".$name.".\n\n".$message;
        mail($mailTo, $subject, $txt, $headers); 
    }

    public function loginUser($uid, $pwd) {

        if(empty($uid) || empty($pwd)) {
            return 'All fields are required!';
        } else {
            $results = $this->checkUser($uid);
            if(empty($results)) {
                return 'You used an invalid username or email!';
            } else {
                $hashedPwdCheck = password_verify($pwd, $results[0]['pwd']);
                if($hashedPwdCheck == false) {
                    return 'You used an invalid password!';
                } elseif ($hashedPwdCheck == true) {

                    if($results[0]['verified'] == 0) {
                        header("Location: ".ROOT_URL."verify?email=".$results[0]['email']."");
                    } else {
                    $_SESSION['id'] = $results[0]['id'];
                    $_SESSION['firstname'] = $results[0]['firstname'];
                    $_SESSION['lastname'] = $results[0]['lastname'];
                    $_SESSION['email'] = $results[0]['email'];
                    $_SESSION['uid'] = $results[0]['uid'];
                    $_SESSION['folderCode'] = $results[0]['folder_code'];
                    $newStat = $results[0]['uid'];
                    $this->updateStatus($newStat);
                    echo '
                    <script>
                    window.location = "dashboard";
                    </script>
                    ';                
                }
                }

            }
        }   

    }

    public function validateUser($email, $code) {
        $email = htmlspecialchars($email);
        $code = htmlspecialchars($code);
        $results = $this->checkEmail($email);
        
        if($results[0]['code'] == $code) {
            // change verified status to 1
            $this->updateVerifiedStatus(1, $email);

            // Log In the user
            $this->loginUser($results[0]['uid'], $results[0]['pure_pwd']);
            
        } else {
            return 'Invalid verification code!';
        }
    }

    public function generateKey($num) {
        $keyLength = $num;
        $str = uniqid($_SESSION['email'].$_SESSION['uid']);
        $randStr = substr(str_shuffle($str), 0, $keyLength);
        return $randStr;
    }

    public function reArrayFiles($file_post) {
        $file_ary = array();
        $file_count = count($file_post['name']);
        $file_keys = array_keys($file_post);

        for ($i = 0; $i < $file_count; $i++) {
            foreach($file_keys as $key) {
                $file_ary[$i][$key] = $file_post[$key][$i];
            }
        }
        return $file_ary;
    }

    public function uploadBook($file, $option, $description) {

        $phpFileUploadErrors = array(
            0 => 'There is no error, the file uploaded with success',
            1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
            2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
            3 => 'The uploaded file was only partially uploaded',
            4 => 'No file was uploaded',
            6 => 'Missing a temporary folder',
            7 => 'Failed to write file to disk',
            8 => 'A php EXTENSION stopped the file upload.'  
        );

        $file_array = $this->reArrayFiles($file);
        $t = array();
        $y = 0;
        for($i=0;$i<count($file_array);$i++) {
            if($file_array[$i]['error']) {
                echo $file_array[$i]['name'].' - '.$phpFileUploadErrors[$file_array[$i]['error']];   
            } else {
                $extensions = array('pdf', 'txt', 'doc', 'docx', 'ppt', 'pps', 'rar', 'rar4', 'zip', '7z', 'xls', 'xlr', 'log', 'msg', 'pages', 'rtf', 'tex', 'wpd', 'wps', 'csv', 'dat', 'odt', 'tex', 'wps', 'csv', 'key', 'sdf', 'tar', 'tax2016', 'tax2018', 'vcf', 'indd', 'xlr', 'ods'); // allowed arrays
                $file_ext = explode('.', $file_array[$i]['name']);
                $file_ext = end($file_ext);

                if(!in_array($file_ext, $extensions)) {
                    echo  "{$file_array[$i]['name']} - Invalid file extension!";
                } else {
                    $fileName = $file_array[$i]['name'];
                    $fileSize = $file_array[$i]['size'];
                    $code = $this->getFileCode(6);
                    if($option == 'public') {
                        $visible = 1;
                    } else {
                        $visible = 0;
                    }
                    $description = htmlspecialchars($description);
                    $user_id = $_SESSION['id'];
                    $time = date('M d, Y').' at '.date('h:ia');


                    if($file_array[$i]['size'] < 1000000000) {
                    move_uploaded_file($file_array[$i]['tmp_name'], $this->uploadLocation().$_SESSION['folderCode']."/".$fileName);
                    $this->insertBook($fileName, $fileSize, $description, $code, $user_id, $visible, $time);
                    }
                    $this->jsRedirect("uploads");
                }
            }
        }

    }
    
    public function makeReport($name, $telephone, $email, $title, $message, $user_id) {

        $name = htmlspecialchars($name);
        $telephone = htmlspecialchars($telephone);
        $email = htmlspecialchars($email);
        $title = htmlspecialchars($title);
        $message = htmlspecialchars($message);
        $user_id = htmlspecialchars($user_id);

        if(empty($name) || empty($telephone) || empty($email) || empty($title) || empty($message)) {
            return 'Please fill in all fields!';            
        } else {
        $name = ucwords($name);
  

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return 'You have used an invalid email!';
        } else { 
                $this->insertReport($name, $telephone, $email, $title, $message, $user_id);
                header("Location: feedback?sent");
               
            }
        }
    } 



   // update time

    public function updateBookDetails($file_name, $description, $code, $user_id) {

            $file_name = htmlspecialchars($file_name);
            $description = htmlspecialchars($description);

            if(empty($file_name)) {
                return '<li>The name of file is required!</li>';
            } else {
                if(empty($user_id) || $user_id !== $_SESSION['id']) {
                    return '<li>E-book upload error!</li>';
            } else {
                if(!preg_match("/^[a-zA-Z- 0-9 _.,()]*$/", $file_name)) {
                    return '<li>Invalid characters present in file_name!</li><br>';

                    } else {

                    

                    $time = date('M d, Y').' at '.date('h:ia');

                    // rename the file
                    $results = $this->checkCode($code);
                    rename($this->uploadLocation().$_SESSION['folderCode'].'/'.$results[0]['file_name'], $this->uploadLocation().$_SESSION['folderCode'].'/'.$file_name);

                    // echo $this->uploadLocation().$_SESSION['folderCode'].'/'.$results[0]['file_name'];
                    // echo '<br>';
                    // echo $this->uploadLocation().$_SESSION['folderCode'].'/'.$file_name;

                    $this->insertBookUpdate($file_name, $description, $time, $code);
                    header("Location: uploads");
                }
            }
 
        
}
            }
    

    // ------------------------------ Check Visibility -----------------------------------


    public function checkVisibility($code) {
        $code = htmlspecialchars($code);
        $stmt = $this->visibleCheck($code);
        while($row = $stmt->fetch()) {
            if($row['visible'] == 1) {
                $this->hideUpload($code);
            } else {
                $this->showUpload($code);
            }
        }
    }


    public function hideUpload($code) {
        $this->hideVisibility($code);
    }

    public function showUpload($code) {
        $this->makeVisible($code);
    }

    // --------------------------------------------------------------------------------------------

    // --------------------------------- To delete a directory

    public static function deleteDir($dirPath) {
        if(!is_dir($dirPath)) {
            // throw new InvalidArgumentException("$dirPath must be a directory");
            
        }

        if(substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }

        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if(is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
                unlink($dirPath.'.htaccess');
            }
        }

        rmdir($dirPath);
    }

    // ---------------- To delete upload ------------------------------------------------------
    public function deleteUpload($code) {
        $code = htmlspecialchars($code);

        // to delete folders
        $results = $this->checkCode($code);

        $this->eraseUpload($code);

        unlink($this->uploadLocation().$_SESSION['folderCode'].'/'.$results[0]['file_name']);

        // self::deleteDir($this->uploadLocation().$results[0]['file_name'].'/');
    }
    // ------------------------------------------------------------------------------------


    public function test($code) {
        $results = $this->checkCode($code);
        echo $this->uploadLocation().$results[0]['file_name'].'/';
    }


    public function saveSearch($user_id, $search, $time) {
        $this->insertSearches($user_id, $search, $time);      
    }


    
public function updateProfile($firstname, $lastname, $telephone, $about_me, $allowTelephone, $allowEmail, $user_id) {   
    $firstname = htmlspecialchars($firstname);
    $lastname = htmlspecialchars($lastname);

    $telephone = htmlspecialchars($telephone);

    $about_me = htmlspecialchars($about_me);

 
    $time = date('M d, Y').' at '.date('h:ia');

    $this->insertProfileUpdate($firstname, $lastname, $telephone, $about_me, $allowTelephone, $allowEmail, $time, $user_id); 
        header("Location: ".ROOT_URL."dashboard");
                                            
}
              
    

    // To delete all files
    public function deleteFolder($id) {
        // delete the records
        $this->deleteUserUploads($id);

        $user = $this->checkId($id);
        $folderName = $user[0]['folder_code'];

        $dir = 'dir/'.$folderName.'/';

        $files = scandir($dir);

        foreach($files as $file) {
            unlink($dir.$file);
        }

        // delete the folder
        unlink($dir);
    }


    public function performDeletion($id) {
        $this->deleteFolder($id);
        $this->deleteAccount($id);
        session_unset();
        session_destroy();
        header("Location: ".ROOT_URL."");

    }

    public function logoutUser($id) {
        session_unset();
        session_destroy();
        $this->logoutStatus($id);
        header("Location: ".ROOT_URL."");
    }


    public function generatePwd($num) {
        $keyLength = $num;
        $str = uniqid("1234567890");
        $randStr = substr(str_shuffle($str), 0, $keyLength);
        return $randStr;
    }

    // E-mail
    public function sendPassword($email) {
        $email = htmlspecialchars($email);

        $results = $this->checkEmail($email);

        if(empty($results)) {
            return 'You used an invalid email!';
        } else {
        $r_email = $results[0]['email'];

        $pwd = $this->generatePwd(7);
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        
        $id = $results[0]['id'];

        // update real password
        $this->updateTxtPassword($pwd, $id);
        
        // update hash
        $this->updatePassword($hashedPwd, $id);

        // --------------- Your new password -------------------
        $name = 'RubberSpace';
        $subject = 'Password Reset';
        $mailFrom = 'rubberspace.space@gmail.com';
        $message = "Your new password is ".$pwd."";
        
        $mailTo = "".$results[0]['email']."";
        $headers = "From: ".$mailFrom;
        $txt = "You have received an e-mail from ".$name.".\n\n".$message;
        mail($mailTo, $subject, $txt, $headers); 
        setcookie("pwd", $pwd);
        header("Location: ".ROOT_URL."reset_password?success");
     }
   }

   public function verifyOTP($otp) {
        $otp = htmlspecialchars($otp);
   }    

   public function validateEmail($email) {
        $email = htmlspecialchars($email);
        return $this->checkEmail($email);
   }

   public function changeUsername($uid, $id) {
        $uid = htmlspecialchars($uid);
        
        if(empty($uid)) {
            return 'A username is required!';
        } else {
            if(stripos($uid, 'anonymous') !== false && strlen($uid) == strlen('anonymous')) {
                return 'You have used an invalid username!';
            } else {
                $results = $this->specialCheckUsername($uid, $id);

                if(!empty($results)) {
                    return 'You have used an invalid username!';
                } else {

                    $check = $this->checkUsername($uid);

                    if($uid == $check[0]['uid']) {
                        header("Location: settings");
                    } else {

                    $this->updateUsername($uid, $id);
                    header("Location: settings?new_uid");
                    }
                }
            }
        }
        
   }

   public function changeEmail($email, $id) {

        $email = htmlspecialchars($email);

        if(empty($email)) {
            return 'An email is required!';
        } else {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return 'You have used an invalid email!';
            } else {

                $results = $this->specialCheckEmail($email, $id);

                if(!empty($results)) {
                    return 'You have used an invalid email!';
                } else {
                    // Check if they are both the same
                    $check = $this->checkEmail($email);
                    if($email == $check[0]['email']) {
                        header("Location: settings");
                    } else {
                    // update email, set verified = 0, sendCode(), redirect to verify
                    
                    // update email
                    $this->updateEmail($email, $id);

                    // set Verified to 0
                    $this->updateVerifiedStatus(0, $email);

                    // Send Code
                    $this->sendCode($email);

                    // Redirect to Verify
                    session_unset();
                    session_destroy();
                    header("Location: verify?email=".$email."");                        
                    }
                    
                }
            }
        }
   }
} 
