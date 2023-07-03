<?php
    include "connect.php";
    
?>

<?php
    $tmpl ='includes/tmpl/';
    $css ='layout/css/';
    $lang = 'includes/lang/';
    $func ='includes/func/';
    include $lang . "english.php";
    include $func .'title.php';
    include $tmpl .'header.php';
    
    if(!isset($nonavbar)){include $tmpl . "navbar.php";}

    
    