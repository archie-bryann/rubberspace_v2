<?php
    include 'headerInc.php';

    $search = $_POST['q'];
    $userNewCount = $_POST['fileNewCount'];

    $more = new Search();
    $more->getFiles($search, $userNewCount);
?>