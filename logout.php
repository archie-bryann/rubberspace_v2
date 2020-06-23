<?php
    include 'headerInc.php';

    $logout = new Class() extends Users {
        public function logoutUser($uid) {
            $this->updateStatusLoggedOut($uid);
        }
    };

    $logout->logoutUser($_SESSION['uid']);

    session_unset();
    session_destroy();

    header("Location: ".ROOT_URL."");
    