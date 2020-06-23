<?php

class AngelContr extends Users {

    // insert requests into database
    public function catchUrl() {
        $url  = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
 
         if(isset($url)) {
             $this->insertUrl($url);
         }
    }
 
    public function checkRequests() {
        return $this->countRequests();
    }
 
    public function showUsers() {
        return $this->countUsers();
    }
 
    public function showLoggedIn() {
         return $this->countLoggedIn();
    }
 
    public function showLoggedOut() {
         return $this->countLoggedOut();
    }

    public function showVisits() {
        return $this->countVisits();
    }

    public function catchUpload($fileName) {
        $time = date('M d, Y').' at '.date('h:ia');
        $user_id = $_SESSION['id'];
        $this->insertUpload($fileName, $time, $user_id);
    }

    public function showUploads() {
        return $this->countUploads2();
    }

}
