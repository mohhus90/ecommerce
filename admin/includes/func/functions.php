<?php
    function getTitle(){
        global $title;
        if (isset($title)){
            echo $title;
        }else{
            echo 'Default';
        }

    }

    function redirect($message , $second =4){
        echo "<div class='alert alert-danger text-center col-lg-4 col-lg-offset-4 '>.$message.</div>";
        echo "<div class='alert alert-info text-center col-lg-4 col-lg-offset-4 '> you will redirect to homepage after .$second. seconds</div>";
        header ("refresh:$second;url=index.php");
        exit();
    }

    function checkitem($select,$from,$value){
        global $con;
        $stmnt= $con->prepare("SELECT $select FROM $from WHERE $select= ?");
        $stmnt->execute(array($value));
        $count = $stmnt->rowCount();
        return $count;

    }