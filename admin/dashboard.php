<?php
      session_start();
      $title = 'Dashboard';
      
      if(isset($_SESSION['username'])){
        //   header('location: dashboard.php');
          // echo '<h1>Welcome to Dashboard </h1>' . $_SESSION['username'];
          include "init.php";
          echo 'welcome';
          include $tmpl."footer.php";
      }
      else{
        header('location: index.php');
        exit();
        
      }
      
?>
