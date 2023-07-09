<?php
      session_start();
      $title = 'Dashboard';
      
      if(isset($_SESSION['username'])){
        //   header('location: dashboard.php');
          // echo '<h1>Welcome to Dashboard </h1>' . $_SESSION['username'];
          include "init.php";
            ?>
              <div class='container dash home-stats text-center'>
                <h1> Dashboard</h1>
                <div class= 'row'>
                  <div class='col-md-4'>
                    <div class='dash-stat stat'>
                      Total Members
                      <span>
                        200
                      </span>
                    </div>
                  </div>
                
                
                  <div class='col-md-4'>
                    <div class='dash-stat stat'>
                      Pending Members
                      <span>
                        200
                      </span>
                    </div>
                  </div>
                
                
                  <div class='col-md-4'>
                    <div class='dash-stat stat'>
                      Total Items
                      <span>
                        200
                      </span>
                    </div>
                  </div>
                </div>
              </div>

            <?php
          include $tmpl."footer.php";
      }
      else{
        header('location: index.php');
        exit();
        
      }
      
?>
