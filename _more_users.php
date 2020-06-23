<?php
    include 'headerInc.php';

    $search = $_POST['q'];
    $userNewCount = $_POST['userNewCount'];

    $more = new Search();
    $more->getUsers($search, $userNewCount);
?>