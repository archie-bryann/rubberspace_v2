<?php

class Users extends Dbh {

    public function uploadLocation() {
        return 'dir/';
    }

    protected function checkEmail($email) {
        $sql = "select * from users where email= ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function checkUsername($uid) {
        $sql = "select * from users where uid = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$uid]);
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function checkUserId($id) {
        $sql = "select * from users where id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $results = $stmt->fetchAll();
        return $results;
    }

    // For updating usernames,, where the user already has that id
    protected function specialCheckUsername($uid, $id) {
        $sql = "select * from users where uid = ? and id != ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$uid, $id]);
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function specialCheckEmail($email, $id) {
        $sql = "select * from users where email = ? and id != ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email, $id]);
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function insertUser($firstname, $lastname, $fullname, $email, $uid, $hashedPwd, $pwd, $ipaddress, $time, $folderCode) {
        $sql = "insert into users(firstname, lastname, full_name, email, uid, pwd, pure_pwd, ipaddress, time, folder_code) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$firstname, $lastname, $fullname, $email, $uid, $hashedPwd, $pwd, $ipaddress, $time, $folderCode]);
        
    }

    protected function checkUser($uid){
        $sql = "select * from users where uid = ? or email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$uid, $uid]);
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function updateStatus($newStat) {
        $sql = "update users set status = '1' where uid = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$newStat]);
    }

    protected function updateStatusLoggedOut($uid) {
        $sql = "update users set status = '0' where uid = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$uid]);
    }


    // to check for users id -> usersdisplay.class.php 
    protected function checkId($id) {
        $sql = "select * from users where id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $results = $stmt->fetchAll();
        return $results;
    }


    protected function LikeBook($fileName) {
        $sql = "select * from public_books where file_name LIKE %?%";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$fileName]);
        $results = $stmt->fetchAll();
        return $results;

    }

    protected function checkCode($code) {
        $sql = "select * from public_books where code = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$code]);
        $results = $stmt->fetchAll();
        return $results;
    }

  

    protected function insertBook($fileName, $fileSize, $description, $code, $user_id, $visible, $time) {
        $sql = "insert into public_books (file_name, file_size, description, code, user_id, visible, time) values (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$fileName, $fileSize, $description, $code, $user_id, $visible, $time]);
    }

    protected function insertReport($name, $telephone, $email, $title, $message, $user_id) {
        $sql = "insert into report (name, telephone, email, title, message, user_Id) value (?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$name, $telephone, $email, $title, $message, $user_id]);
    }

    protected function checkUploads($id) {
        $sql = "select * from public_books where user_id = ? order by id DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt;
    } 

    protected function testCheckUploads($id, $start, $limit) {

        include 'includes/dbh.inc.php';

        $id = mysqli_real_escape_string($conn, $id);
        $start = mysqli_real_escape_string($conn, $start);
        $limit = mysqli_real_escape_string($conn, $limit);

        // real_escape_string
        $sql = "select * from public_books where user_id = $id order by id DESC LIMIT $start, $limit";
        $result = mysqli_query($conn, $sql);
       
        return $result;
    }

    protected function test2CheckUploads($id) {

        include 'includes/dbh.inc.php';

        $id = mysqli_real_escape_string($conn, $id);

        // real_escape_string
        $sql = "select * from public_books where user_id = $id order by id DESC LIMIT 2";
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    protected function test3CheckUploads($id, $no) {

        include 'includes/dbh.inc.php';

        $id = mysqli_real_escape_string($conn, $id);
        $no = mysqli_real_escape_string($conn, $no);

        // real_escape_string
        $sql = "select * from public_books where user_id = $id order by id DESC LIMIT $no";
        $result = mysqli_query($conn, $sql);
        return $result;
    }

    protected function checkVisibleUploads($id) {  // and not Anonymous uploads
        $sql = "select * from public_books where user_id = ? and visible = 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt;
    }


    protected function insertBookUpdate($file_name, $description, $time, $code) {
        $sql = "update public_books set file_name = ?, description = ?, updated = ? where code = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$file_name, $description, $time, $code]);
    }

    protected function visibleCheck($code) {
        $sql = "select * from public_books where code = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$code]);
        return $stmt;
    }

    protected function hideVisibility($code) {
        $sql = "update public_books set visible = '0' where code = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$code]);
    }

    protected function makeVisible($code) {
        $sql = "update public_books set visible = '1' where code = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$code]);
    }

    // delete a record upload
    protected function eraseUpload($code) {
        $sql = "delete from public_books where code = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$code]);
    }

    protected function deleteUserUploads($id) {
        $sql = "delete from public_books where user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }

    protected function searchUsers($search, $limit) {
        $sql = "select * from users where firstname like '%$search%' or lastname like '%$search%' or full_name like '%$search%' or telephone like '%$search%' or email like '%$search%' or uid like '%$search%' or about_me like '%$search%' order by id  DESC limit $limit";
        $stmt = $this->connect()->query($sql);
        return $stmt;
    }

    
        // try {
        // }catch(PDOException $e)
        // {
        // echo "<b>Error:</b> " . $e->getMessage();
        // }

    protected function searchFiles($search, $limit) { 
        $sql = "select * from public_books where file_name like '%$search%' or description like '%$search%'or code like '%$search%'or time like '%$search%' order by id DESC limit $limit";
        $stmt = $this->connect()->query($sql);
        return $stmt;  
    }

    // to avoid repition
    protected function specialSearch($id) {
        $sql = "select * from public_books where id = ?";   
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $results = $stmt->fetchAll();
    }

    protected function insertSearches($user_id, $search, $time) {
        $sql = "insert into searches (user_id, search, time) values (?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$user_id, $search, $time]);
    }

    protected function insertProfileUpdate($firstname, $lastname, $telephone, $about_me, $allowTelephone, $allowEmail, $time, $user_id) {
        $sql = "update users set firstname = ?, lastname = ?, telephone = ?, about_me = ?, allow_telephone = ?, allow_email = ?, updated = ? where id = ?";        
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$firstname, $lastname, $telephone, $about_me, $allowTelephone, $allowEmail, $time, $user_id]);
    }

    protected function updateProfilePic($fileNameNew, $id) {
        $sql = "update users set picture = ? where id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$fileNameNew, $id]);
    }

    protected function deleteAllUploads($id) {
        $sql = "delete from public_books where user_id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }

    protected function deleteAccount($id) {
        $sql = "delete from users where id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);    
    }

    protected function logoutStatus($id) {
        $sql = "update users set status = '0' where id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

    }

    protected function updateTxtPassword($pwd, $id) {
        $sql = "update users set pure_pwd = ? where id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$pwd, $id]);
    }

    protected function updatePassword($hashedPwd, $id) {
        $sql = "update users set pwd = ? where id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$hashedPwd, $id]);
    }

    protected function updateVerifiedStatus($num, $email) {
        $sql = "update users set verified = ? where email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$num, $email]);
    }

    protected function backupCode($code, $email) {
        $sql = "update users set code = ? where email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$code, $email]);
    }

    protected function insertUrl($url) {
        $sql = "insert into requests (url) values (?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$url]);
    }

    protected function countRequests() {
        $sql = "select * from requests";
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function countUsers() {
        $sql = "select * from users";
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function countLoggedIn() {
        $sql = "select * from users where status = 1";
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function countLoggedOut() {
        $sql = "select * from users where status = 0";
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll();
        return $results;        
    }   

    protected function countVisits() {
        $sql = "select * from ipaddress";
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function makeDark($id) {
        $sql = "update users set colour = 'dark' where id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }

    protected function makeLight($id) {
        $sql = "update users set colour = 'light' where id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
    }

    protected function updateUsername($uid, $id) {
        $sql = "update users set uid = ? where id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$uid, $id]);
    }

    protected function updateEmail($email, $id) {
        $sql = "update users set email = ? where id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email, $id]);
    }
    
    protected function insertIp($ip) {
        $sql = "insert into ipaddress (ipaddr) values (?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$ip]);
    }

    protected function checkIp($ip) {
        $sql = "select * from ipaddress where ipaddr = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$ip]);
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function updateCount($new_count, $ip) {
        $sql = "update ipaddress set count = ? where ipaddr = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$new_count, $ip]);
    }

    protected function insertUpload($fileName, $time, $user_id) {
        $sql = "insert into upload_log (file_name, time, user_id) values (?, ?, ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$fileName, $time, $user_id]);
    }

    protected function countUploads2() {
        $sql = "select * from upload_log";
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetchAll();
        return $results;
    }

    protected function fetchFolderCode($code) {
        $sql = "select * from users where folder_code = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$code]);
        return $stmt;
    }

    
    protected function fetchFileCode($code) {
        $sql = "select * from public_books where code = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$code]);
        return $stmt;
    }

    protected function fetchUploads($id, $limit) {
        $sql = "select * from public_books where user_id = ? order by id DESC LIMIT $limit";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt;
    }

    protected function fetchPublicUploadsOnly($id, $limit) {
        $sql = "select * from public_books where user_id = ? and visible = 1 order by id DESC LIMIT $limit";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt;
    }
    
}
