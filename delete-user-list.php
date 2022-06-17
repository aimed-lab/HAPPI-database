<?php

$happiDoc=include_once '../documents-location.php';
include_once $happiDoc.'classes/dbutility.php';

if(isset ($_POST['deleteList'])){
    if(!isset($_SESSION)){
        session_start();
    }
    $uid=$_SESSION['userId'];
    $deleteList=$_POST['deleteList'];

    dbutility::deleteUserList($uid, $deleteList);
    echo "<span class='success'>The selected lists are successfully deleted.</span>";
}

?>
