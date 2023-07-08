<?php
    function getTitle(){
        global $title;
        if (isset($title)){
            echo $title;
        }else{
            echo 'Default';
        }

    }
    function redirect($errmsg, $url, $seconds = 3){
       
        if(empty($url)){
            $url='index.php';
        }else{
            if(isset($_SERVER['HTTP_REFERER'])){
                $url=$_SERVER['HTTP_REFERER'];
            }else{
                $url='index.php';   
            }
        }
        echo $errmsg;
        echo '<div class = "alert alert-info col-md-6 container text-center d-flex align-items-center justify-content-center"> you will redirect to' .$url.' in '.$seconds.' seconds</div>';
        header("refresh:$seconds; url=$url");
    }
  
    
    