<?php
    $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
    
    if($do=='manage'){
        echo 'wel to manage page';
    }elseif($do=='add'){
        echo 'wel to ADD page';
    }elseif($do=='insert'){
        echo 'wel to INSERT page';
    }else{
        echo 'ERROR';
    }