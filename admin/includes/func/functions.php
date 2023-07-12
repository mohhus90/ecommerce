<?php
    function getTitle(){
        global $title;
        if (isset($title)){
            echo $title;
        }else{
            echo 'Default';
        }

    }

    function checkitem($select,$from,$value){
        global $con;
        $stmnt= $con->prepare("SELECT $select FROM $from WHERE $select= ?");
        $stmnt->execute(array($value));
        $count = $stmnt->rowCount();
        return $count;

    }

    function redirect($errmsg, $url, $seconds = 3){
       
        if(empty($url)){
            $url='index.php';
        }else{
            if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!==""){
                $url=$_SERVER['HTTP_REFERER'];
            }else{
                $url='index.php';   
            }
        }
        echo $errmsg;
        echo '<div class = "alert alert-info col-md-6 container text-center d-flex align-items-center justify-content-center"> you will redirect to' .$url.' in '.$seconds.' seconds</div>';
        header("refresh:$seconds; url=$url");
    }
  function cont($item, $table){
    global $con;
    $stmnt2 = $con->prepare("SELECT COUNT($item) FROM $table;");
    $stmnt2->execute();
    return $stmnt2->fetchColumn();
  }
    function latest($selects,$tables,$orders,$descs,$limits){
        global $con;
        $stm = $con->prepare("SELECT $selects FROM $tables ORDER BY $orders $descs LIMIT $limits ;");
        $stm->execute();
        $rows=$stm->fetchall();
        return $rows;

    }
    