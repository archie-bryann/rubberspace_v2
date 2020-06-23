<?php

   
class UsersDisplay extends Users {

    private $id;
    private $results;

    public function __construct($userId) {
        $this->id = $userId;
        $this->results = $this->checkId($this->id);
    }

   
    public function displayId() {
        return $this->results[0]['id'];
    }



    public function displayFirst() {
        return $this->results[0]['firstname'];
    }

    public function displayLast() {
        return $this->results[0]['lastname'];
    }

    public function displayName() {
        return $this->results[0]['firstname'] . ' ' . $this->results[0]['lastname'];
    }

    public function displayUsername() {
        return $this->results[0]['uid'];
    }

    public function displayTelephone() {
        return $this->results[0]['telephone'];
    }

    public function displayEmail() {
        return $this->results[0]['email']; 
    }

    public function displayStudent() {
        return $this->results[0]['student_of'];
    }

    public function displayWork() {
        return $this->results[0]['work_at'];
    }

    public function displayAbout() {
        return $this->results[0]['about_me'];
    }

    public function displayAllowTelephone() {
        return $this->results[0]['allow_telephone'];
    }

    public function displayAllowEmail() {
        return $this->results[0]['allow_email'];
    }

    public function displayTime() {
        return $this->results[0]['time'];
    }

    public function displayUpdated() {
        return $this->results[0]['updated'];
    }    
}
