<?php
      ob_start();
      session_start();
      $title = 'Items';    
    if(isset($_SESSION['username'])){
        include "init.php";
        $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
            if($do=='manage'){
              
              $stmt = $con->prepare("SELECT * FROM items INNER JOIN users ON items.user_id = users.userid;");
              $stmt->execute(array());
              $rows = $stmt->fetchall();
              
              ?>
          <h1 class='text-center'><i class="fa fa-tag icon"></i> Manage Items</h1>
            <div class= 'container'>
              <div class='table-responsive'>
                <table class= 'table table-bordered thead-dark main-table text-center' >
                
                  <tr style="border-color:blue;" >
                    <td>#ID</td>
                    <td>Items</td>
                    <td>Description</td>
                    <td>cost</td>
                    <td>Quantity</td>
                    <td>Total</td>
                    <td>unit</td>
                    <td>user</td>
                    <td>Modify Date</td>
                    <td>Control</td>
                  </tr>
                
                  <?php
                  
                     foreach($rows as $row) {
                      echo '<tr style="border-color:rgb(124, 114, 114);" >';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['itemid'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['name'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['description'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['cost'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['quantity'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['quantity']*$row['cost'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['unit'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['username'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['add_date'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">';
                      echo '<a href="items.php?do=edit&itemid='. $row['itemid'].'" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>';
                      echo ' ';
                      echo '<a href="items.php?do=delete&itemid='. $row['itemid'].'" class="btn btn-danger confirm"><i class="fa fa-close"></i> Delete</a>';
                      echo ' ';
                      if($row['regstatus']==0){
                        echo '<a href="items.php?do=active&itemid='. $row['itemid'].'" class="btn btn-info "><i class="fa fa-check"></i> active</a>';
                      }
                      echo '</td>';
                      echo '</tr>';
                    } 
                    
                  ?>
                    
  
                </table>
              </div>
              <a href="items.php?do=add" class='btn btn-primary'><i class="fa fa-plus" ></i> New Item</a>
            </div>
          <?php
        }elseif($do=='add'){?>
            <h1 class='text-center'><i class="fa fa-tag"></i> Add Item</h1>
          <div class= ' container'>  
            <form class= 'justify-content-center col-sm-9' action="?do=insert" method="POST">
            
              <div  class='form-group row'>
              <label class= 'col-sm-2 control-label'></label>
                  <label class= 'col-sm-2 control-label'>Item</label>
                  <div class='col-sm-8'>
                    <input class='form-control' type='text' name='item' required='required' />
                  </div>
              </div>
              <div  class='form-group row'>
              <label class= 'col-sm-2 control-label '></label>
                  <label class= 'col-sm-2 control-label'>Description</label>
                  <div class='col-sm-8'>
                    <input class='form-control' type='text' name='description' />
                  </div>
              </div>
              <div  class='form-group row'>
              <label class= 'col-sm-2 control-label'></label>
                  <label class= 'col-sm-2 control-label'>Cost</label>
                  <div class='col-sm-8'>
                    <input class='form-control' type='text' name='cost' required='required'/>
                  </div>
              </div>
              <div  class='form-group row'>
              <label class= 'col-sm-2 control-label'></label>
                  <label class= 'col-sm-2 control-label'>Quantity</label>
                  <div class='col-sm-8'>
                    <input class='form-control' type='text' name='quantity' required='required'/>
                  </div>
              </div>
              <div  class='form-group row'>
              <label class= 'col-sm-2 control-label'></label>
                  <label class= 'col-sm-2 control-label'>Unit</label>
                  <div class='col-sm-8'>
                    <input class='form-control' type='text' name='unit' required='required' />
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
                $item= $_POST['item'];
                $Desc= $_POST['description'];
                $cost= $_POST['cost'];
                $quantity= $_POST['quantity'];
                $unit = $_POST['unit'];
                $userid = $_SESSION['ID'];
                  $cheked= checkitem('name','items',$item);
                      if($cheked >0){ 
                        $errmsg = '<div class="alert alert-danger text-center d-flex justify-content-center">'. 'This item is already exist' .'</div>';
                        redirect($errmsg,'back');

                      }else{
                            $stmt = $con->prepare("INSERT INTO items (name,description,cost,quantity,unit,user_id,add_date) VALUES(?,?,?,?,?,?,now())");
                            $stmt->execute(array($item,$Desc,$cost,$quantity,$unit,$userid));
                            $count= $stmt->rowCount();
                            $errmsg= '<div class="alert alert-success col-md-6 container text-center d-flex align-items-center justify-content-center">'.$count .' '. ' Record Succesfully Inserted</div>';
                            redirect($errmsg,'back');
                      }
                }else{
                  $errmsg = '<div class="alert alert-danger text-center d-flex justify-content-center">'. 'You can not request directly' .'</div>';
                  redirect($errmsg,'back');

                }
        }elseif($do=='edit'){
              $itemid=isset($_GET['itemid']) && is_numeric($_GET['itemid'])? intval($_GET['itemid']):0;
                  $stmt = $con->prepare("SELECT * FROM items WHERE itemid = ? LIMIT 1");
                  $stmt->execute(array($itemid));
                  $row = $stmt->fetch();
                  $count= $stmt->rowCount();
                  if($count >0){?>
                          <h1 class='text-center'><i class="fa fa-tag"></i> Edit Item</h1>
                          <div class= ' container'>  
                            <form class= 'justify-content-center col-sm-9' action="?do=update" method="POST">
                            <input  type='hidden' value="<?php echo $row['itemid']?>" name='itemid' />
                              <div  class='form-group row'>
                              <label class= 'col-sm-2 control-label'></label>
                                  <label class= 'col-sm-2 control-label'>Item</label>
                                  <div class='col-sm-8'>
                                    <input class='form-control' type='text' value="<?php echo $row['name']?>"name='item' required='required' />
                                  </div>
                              </div>
                              <div  class='form-group row'>
                              <label class= 'col-sm-2 control-label '></label>
                                  <label class= 'col-sm-2 control-label'>Description</label>
                                  <div class='col-sm-8'>
                                    <input class='form-control' value="<?php echo $row['description']?>" type='text' name='description' />
                                  </div>
                              </div>
                              <div  class='form-group row'>
                              <label class= 'col-sm-2 control-label'></label>
                                  <label class= 'col-sm-2 control-label'>Cost</label>
                                  <div class='col-sm-8'>
                                    <input class='form-control' type='text' value="<?php echo $row['cost']?>" name='cost' required='required'/>
                                  </div>
                              </div>
                              <div  class='form-group row'>
                              <label class= 'col-sm-2 control-label'></label>
                                  <label class= 'col-sm-2 control-label'>Quantity</label>
                                  <div class='col-sm-8'>
                                    <input class='form-control' type='text' value="<?php echo $row['quantity']?>" name='quantity' required='required'/>
                                  </div>
                              </div>
                              <div  class='form-group row'>
                              <label class= 'col-sm-2 control-label'></label>
                                  <label class= 'col-sm-2 control-label'>Unit</label>
                                  <div class='col-sm-8'>
                                    <input class='form-control' type='text' value="<?php echo $row['unit']?>" name='unit' required='required' />
                                  </div>
                              </div>
                              <div  class='form-group row'>
                              <label class= 'col-sm-2 control-label'></label>
                                  <label class= 'col-sm-2 control-label'></label>
                                  <div class='col-sm-8'>
                                    <input class='btn btn-primary btn-block' type='submit' value='update' />
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
                $id=  $_POST['itemid'];
                $item= $_POST['item'];
                $Desc= $_POST['description'];
                $cost= $_POST['cost'];
                $quantity= $_POST['quantity'];
                $unit = $_POST['unit'];
                $userid = $_SESSION['ID'];
                $stmt = $con->prepare("SELECT * FROM items WHERE name = ? AND itemid != ? LIMIT 1");
                        $stmt->execute(array($item,$id));
                        $row = $stmt->fetch();
                        $cheked= $stmt->rowCount();
                        if($cheked == 0){
                            $stmt = $con->prepare("UPDATE items SET name = ?, description = ?, cost =?, quantity=?, unit=?, user_id=?, add_date=now() where itemid= ?");
                            $stmt->execute(array($item,$Desc,$cost,$quantity,$unit,$userid,$id));
                            $count= $stmt->rowCount();

                            $errmsg= '<div class="alert alert-success col-md-6 container text-center d-flex align-items-center justify-content-center">'.$count .' '. ' Record Succesfully Updated</div>';
                            redirect($errmsg,'items.php');
                          }else{
                            $errmsg= '<div class="alert alert-success col-md-6 container text-center d-flex align-items-center justify-content-center">This item is already exist</div>';
                            redirect($errmsg, 'back',4);
                          }
                }else{
                  $errmsg= '<div class="alert alert-success col-md-6 container text-center d-flex align-items-center justify-content-center">you canot browse this page directly</div>';
                  redirect($errmsg);
                }

        }elseif($do=='delete'){
          echo "<h1 class='text-center'>Delete Item</h1>";
              $itemid=isset($_GET['itemid']) && is_numeric($_GET['itemid'])? intval($_GET['itemid']):0;
                  $stmt = $con->prepare("DELETE FROM items WHERE itemid = ? LIMIT 1");
                  $stmt->execute(array($itemid));
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
