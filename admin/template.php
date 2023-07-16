<?php
      ob_start();
      session_start();
      $title = '';    
    if(isset($_SESSION['username'])){
        include "init.php";
        $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
        if($do=='manage'){
        
        }elseif($do=='add'){

        }elseif($do=='insert'){

        }elseif($do=='edit'){

        }elseif($do=='update'){

        }elseif($do=='delete'){

        }elseif($do=='active'){

        }

        include $tmpl."footer.php";

      }else{
        $seconds=3;
        $url='index.php';
        echo'<div class="alert alert-success col-md-6 container text-center d-flex align-items-center justify-content-center">Sorry you not have authorized</div>';
        echo '<div class = "alert alert-info col-md-6 container text-center d-flex align-items-center justify-content-center"> you will redirect to' .$url.' in '.$seconds.' seconds</div>';
        header("refresh:$seconds; url=$url");
      }
  ob_end_flush();    
?>
