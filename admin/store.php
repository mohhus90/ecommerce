<?php
      ob_start();
      session_start();
      $title = 'Items';    
    if(isset($_SESSION['username'])){
        include "init.php";
        $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
            if($do=='manage'){
              
              $stmt = $con->prepare("SELECT * FROM store INNER JOIN users ON store.user_id = users.userid;");
              $stmt->execute(array());
              $rows = $stmt->fetchall();
              
              ?>
          <h1 class='text-center'><i class="fa fa-store icon"></i> Manage store</h1>
            <div class= 'container'>
              <div class='table-responsive'>
                <table class= 'table table-bordered thead-dark main-table text-center' >
                
                  <tr style="border-color:blue;" >
                    <td>#ID</td>
                    <td>Store name</td>
                    <td>username</td>
                    <td>add date</td>
                    <td>modify date</td>
                    <td>Control</td>
                  </tr>
                  <?php
                     foreach($rows as $row) {
                      echo '<tr style="border-color:rgb(124, 114, 114);" >';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['storeid'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['store_name'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['username'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['add_date'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['mod_date'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">';
                      echo '<a href="store.php?do=edit&storeid='. $row['storeid'].'" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>';
                      echo ' ';
                      echo '<a href="store.php?do=delete&storeid='. $row['storeid'].'" class="btn btn-danger confirm"><i class="fa fa-close"></i> Delete</a>';
                      echo ' ';
                      if($row['regstatus']==0){
                        echo '<a href="store.php?do=active&storeid='. $row['storeid'].'" class="btn btn-info "><i class="fa fa-check"></i> active</a>';
                      }
                      echo '</td>';
                      echo '</tr>';
                    } 
                    
                  ?>
                    
  
                </table>
              </div>
              <a href="store.php?do=add" class='btn btn-primary'><i class="fa fa-plus" ></i> New Item</a>
            </div>
          <?php
        }elseif($do=='add'){?>
            <h1 class='text-center'><i class="fa fa-store icon"></i> Add store</h1>
          <div class= ' container'>  
            <form class= 'justify-content-center col-sm-9' action="?do=insert" method="POST">
            
              <div  class='form-group row'>
              <label class= 'col-sm-2 control-label'></label>
                  <label class= 'col-sm-2 control-label'>store</label>
                  <div class='col-sm-8'>
                    <input class='form-control' type='text' name='store' required='required' />
                  </div>
              </div>
              <div  class='form-group row'>
              <label class= 'col-sm-2 control-label'></label>
                   <label class= 'col-sm-2 control-label'></label>
                   <div class='col-sm-8'>
                    <input class='btn btn-primary btn-block' type='submit' value='add' />
                  </div>
              </div>
            </form>
          </div>
  <?php 
        }elseif($do=='insert'){
              if($_SERVER['REQUEST_METHOD']=='POST'){
                $store= $_POST['store'];
                $userid = $_SESSION['ID'];
                  $cheked= checkitem('store_name','store',$store);
                      if($cheked >0){ 
                        $errmsg = '<div class="alert alert-danger text-center d-flex justify-content-center">'. 'This store is already exist' .'</div>';
                        redirect($errmsg,'back');

                      }else{$stmt = $con->prepare("SELECT * FROM store WHERE store_name = ? LIMIT 1");
                        $stmt->execute(array($store,));
                        $row = $stmt->fetch();
                        $cheked= $stmt->rowCount();
                        if($cheked == 0){
                            $stmt = $con->prepare("INSERT INTO store (store_name,user_id,add_date,mod_date) VALUES(?,?,now(),now())");
                            $stmt->execute(array($store,$userid));
                            $count= $stmt->rowCount();
                            $errmsg= '<div class="alert alert-success col-md-6 container text-center d-flex align-items-center justify-content-center">'.$count .' '. ' Record Succesfully Inserted</div>';
                            redirect($errmsg,'back');
                          }else{
                            $errmsg= '<div class="alert alert-danger col-md-6 container text-center d-flex align-items-center justify-content-center">This store is already exist</div>';
                            redirect($errmsg, 'back',4);
                          }
                      }
                }else{
                  $errmsg = '<div class="alert alert-danger text-center d-flex justify-content-center">'. 'You can not request directly' .'</div>';
                  redirect($errmsg,'back');

                }
        }elseif($do=='edit'){
              $storeid=isset($_GET['storeid']) && is_numeric($_GET['storeid'])? intval($_GET['storeid']):0;
                  $stmt = $con->prepare("SELECT * FROM store WHERE storeid = ? LIMIT 1");
                  $stmt->execute(array($storeid));
                  $row = $stmt->fetch();
                  $count= $stmt->rowCount();
                  if($count >0){?>
                          <h1 class='text-center'><i class="fa fa-store icon"></i> Edit store</h1>
                          <div class= ' container'>  
                            <form class= 'justify-content-center col-sm-9' action="?do=update" method="POST">
                            <input  type='hidden' value="<?php echo $row['storeid']?>" name='storeid' />
                              <  <div  class='form-group row'>
                          <label class= 'col-sm-2 control-label'></label>
                              <label class= 'col-sm-2 control-label'>store</label>
                              <div class='col-sm-8'>
                                <input class='form-control' type='text' value="<?php echo $row['store_name']?>"  name='store' required='required' />
                              </div>
                                </div>
                                <div  class='form-group row'>
                                <label class= 'col-sm-2 control-label'></label>
                                    <label class= 'col-sm-2 control-label'></label>
                                    <div class='col-sm-8'>
                                      <input class='btn btn-primary btn-block' type='submit' value='Update' />
                                    </div>
                                </div>
                          </form>
                          </div>
                          <?php }else{
                                    echo 'there is no user';
                                  }
        }elseif($do=='update'){
          echo "<h1 class='text-center'>Update Item</h1>"; 
          if($_SERVER['REQUEST_METHOD']=='POST'){
                $id=  $_POST['storeid'];
                $store= $_POST['store'];
                $userid = $_SESSION['ID'];
                $stmt = $con->prepare("SELECT * FROM store WHERE storeid != ? and store_name = ? LIMIT 1");
                        $stmt->execute(array($id,$store));
                        $row = $stmt->fetch();
                        $cheked= $stmt->rowCount();
                        if($cheked == 0){
                            $stmt = $con->prepare("UPDATE store SET store_name = ?, user_id=?, mod_date=now() where storeid= ?");
                            $stmt->execute(array($store,$userid,$id));
                            $count= $stmt->rowCount();
                            $errmsg= '<div class="alert alert-success col-md-6 container text-center d-flex align-items-center justify-content-center">'.$count .' '. ' Record Succesfully Updated</div>';
                            redirect($errmsg,'items.php');
                          }else{
                            $errmsg= '<div class="alert alert-danger col-md-6 container text-center d-flex align-items-center justify-content-center">This store is already exist</div>';
                            redirect($errmsg, 'back',4);
                          }
                }else{
                  $errmsg= '<div class="alert alert-success col-md-6 container text-center d-flex align-items-center justify-content-center">you canot browse this page directly</div>';
                  redirect($errmsg);
                }

        }elseif($do=='delete'){
          echo "<h1 class='text-center'>Delete Item</h1>";
              $storeid=isset($_GET['storeid']) && is_numeric($_GET['storeid'])? intval($_GET['storeid']):0;
                  $stmt = $con->prepare("DELETE FROM store WHERE storeid = ? LIMIT 1");
                  $stmt->execute(array($storeid));
                  $count= $stmt->rowCount();
                  $errmsg= '<div class="alert alert-success col-md-6 container text-center d-flex align-items-center justify-content-center">'.$count .' '. 'Record Succesfully Deleted</div>';
                  redirect($errmsg,'back');
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
