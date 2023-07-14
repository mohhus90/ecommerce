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
                        <div >  
                            <form   action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                            <input type='text' placeholder='Enter nuber of request'name='latestno' />
                            <?php 
                            if(empty($_POST['latestno'])){
                              $latestno=3;
                              $rows =latest('*','users','userid','DESC',$latestno);
                              ?>
                      </div>
                      <div class="panel-body border pane2">
                          <ul class="list-unstyled">
                            
                            <?php foreach($rows as $row){
                              
                              echo '<div class="container">';
                              echo '<li>';
                              echo $row['username'];
                              echo '<div class="">';
                              echo '<a href="member.php?do=edit&userid='. $row['userid'].'" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>';
                              echo '</div>';
                              echo '</div>';
                              echo '</li>';
                            
                            }
                          }else{
                              $latestno= $_POST['latestno'];  
                            $rows =latest('*','users','userid','DESC',$latestno);
                            
                            ?>
                      </div>
                      <div class="panel-body border pane2">
                          <ul class="list-unstyled latest-users">
                            
                            <?php foreach($rows as $row){
                              
                              echo '<div class="container">';
                              echo '<li >';
                              echo $row['username'];
                              echo '<div class="">';
                              echo '<a href="member.php?do=edit&userid='. $row['userid'].'" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>';
                              echo '</div>';
                              echo '</div>';
                              echo '</li>';
                            } 
                          }?>
                          </ul>  
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
