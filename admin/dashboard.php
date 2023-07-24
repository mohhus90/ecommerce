<?php
      session_start();
      $title = 'Dashboard';
      
      if(isset($_SESSION['username'])){
        //   header('location: dashboard.php');
          // echo '<h1>Welcome to Dashboard </h1>' . $_SESSION['username'];
          include "init.php";
          
            ?>
              <div class='container dash home-stats text-center'>
                <h1><i class="fa fa-gauge-high icon"></i> Dashboard</h1>
                <div class= 'row'>
                  <div class='col-md-3'>
                    <div class='dash-stat stat st-member'>
                      <i class="fa-solid fa-users fa-4x icons "></i>
                      <div class="totals ">
                        Total Members
                        <span>
                          <a href="member.php"><?php echo cont('userid', 'users'); ?></a>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class='col-md-3'>
                    <div class='dash-stat stat st-pending'>
                    <i class="fa-solid fa-user-plus fa-4x icons"></i>
                    <div class="totals ">
                      Pending Members
                      <span>
                      <a href="member.php?page=pending"><?php echo checkitem('regstatus', 'users',0); ?></a>
                      </span>
                      </div>
                    </div>
                  </div>
                  <div class='col-md-3'>
                    <div class='dash-stat stat st-items'>
                    <i class="fa-solid fa-tag fa-4x icons"></i>
                    <div class="totals ">
                    Total Items
                      <span>
                      <a href="items.php"><?php echo cont('itemid', 'items'); ?></a>
                      </span>
                      </div>
                    </div>
                  </div>
                  <div class='col-md-3'>
                    <div class='dash-stat stat st-comment'>
                    <i class="fa-solid fa-comments fa-4x icons"></i>
                    <div class="totals ">
                      Store
                      <span>
                        0
                      </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class ="container latest">
                <div class="row">
                  <div class="col-sm-6 mt-3"><!-- Begain of users Panel -->
                    <div class=" panel panel-default border panel1">
                        <div class="panel-heading latest-reg">
                          <i class="fa fa-users"></i> Latest Registerd Users
                        </div > 
                        <div class=""> 
                          <span class="plus-minus"><i class="fa fa-plus pls"></i></span>
                          </div>
                    </div> <!-- panel panel-default border -->
                    <div class="list-users"><!-- list-users -->
                            <div class="panel-body border panel2">
                              <ul class="list-unstyled">
                                <?php $rows =latest('*','users','userid','DESC',5);
                                foreach($rows as $row){
                                echo '<div class="list">';
                                echo '<li>';
                                echo $row['username'];
                                echo '<div class="div-but">';
                                echo '<a href="member.php?do=edit&userid='. $row['userid'].'" class="btn btn-success button"><i class="fa fa-edit"></i> Edit</a>';
                                echo '</div">';
                                echo '</li>';
                                echo '</div>';
                                }?>
                                </ul>  
                            </div>
                      </div><!-- panel panel-default border panel1 -->
                  </div><!-- col-sm-6 mt-3 --><!-- End of users Panel -->
                  <div class="col-sm-6 mt-3"><!-- Begain of Item Panel -->
                    <div class=" panel panel-default border panel1">
                        <div class="panel-heading latest-reg">
                          <i class="fa fa-tag"></i> Latest Registerd Items
                        </div > 
                        <div class=""> 
                          <span class="plus-minus"><i class="fa fa-plus pls"></i></span>
                          </form>
                          </div>
                    </div> <!-- panel panel-default border -->
                    <div class="list-users"><!-- list-users -->
                            <div class="panel-body border panel2">
                              <ul class="list-unstyled">
                                <?php
                                $items =latest('*','items','itemid','DESC',5); 
                                foreach($items as $item){
                                echo '<div class="list">';
                                echo '<li>';
                                echo $item['name'];
                                echo '<div class="div-but">';
                                echo '<a href="items.php?do=edit&itemid='. $item['itemid'].'" class="btn btn-success button"><i class="fa fa-edit"></i> Edit</a>';
                                echo '</div">';
                                echo '</li>';
                                echo '</div>';
                                }?>
                            </ul>
                          </div>
                      </div><!-- panel panel-default border panel1 -->
                  </div><!-- col-sm-6 mt-3 --><!-- End of Item Panel -->
                </div><!-- row -->
              </div> <!-- container latest -->
              
            <?php
          include $tmpl."footer.php";
      }
      else{
        header('location: index.php');
        exit();
        
      }
      
?>
