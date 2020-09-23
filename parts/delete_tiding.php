<?php
    require_once 'connect.php';
    $link->query("DELETE FROM `news-lab-two` WHERE id = {$_POST['id']} ");
