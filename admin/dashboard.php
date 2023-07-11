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
                  <div class='col-md-3'>
                    <div class='dash-stat stat st-member'>
                      Total Members
                      <span>
                        <a href="member.php"><?php echo cont('userid', 'users'); ?></a>
                      </span>
                    </div>
                  </div>
                  <div class='col-md-3'>
                    <div class='dash-stat stat st-pending'>
                      Pending Members
                      <span>
                      <a href="member.php?page=pending"><?php echo checkitem('regstatus', 'users',0); ?></a>
                      </span>
                    </div>
                  </div>
                  <div class='col-md-3'>
                    <div class='dash-stat stat st-items'>
                      Total Items
                      <span>
                        200
                      </span>
                    </div>
                  </div>
                  <div class='col-md-3'>
                    <div class='dash-stat stat st-comment'>
                      Total Comments
                      <span>
                        200
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <div class ="container latest">
                <div class="row">
                  <div class="col-sm-6 mt-3">
                    <div class="panel panel-default border ">
                      <div class="panel-heading panel1">
                        <i class="fa fa-users"></i> Latest Registerd Users
                      </div>
                      <div class="panel-body border pane2">
                        Test
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 mt-3">
                    <div class="panel panel-default border ">
                      <div class="panel-heading panel1">
                        <i class="fa fa-tag"></i> Latest Items
                      </div>
                      <div class="panel-body border pane2">
                        Test
                      </div>
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
