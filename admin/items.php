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
          <h1 class='text-center'>Manage Items</h1>
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
                      echo '<a href="member.php?do=edit&userid='. $row['userid'].'" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>';
                      echo ' ';
                      echo '<a href="member.php?do=delete&userid='. $row['userid'].'" class="btn btn-danger confirm"><i class="fa fa-close"></i> Delete</a>';
                      echo ' ';
                      if($row['regstatus']==0){
                        echo '<a href="member.php?do=active&userid='. $row['userid'].'" class="btn btn-info "><i class="fa fa-close"></i> active</a>';
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
            <h1 class='text-center'>Add Item</h1>
          <div class= 'container align-items-center justify-content-center'>  
            <form class= 'form-horizontal' action="?do=insert" method="POST">
            
              <div  class='form-group row'>
                  <label class= 'col-sm-1 control-label'>Item</label>
                  <div class='col-sm-8'>
                    <input class='form-control' type='text' name='item' required='required' autocomplete='off' />
                  </div>
              </div>
              <div  class='form-group row'>
                  <label class= 'col-sm-1 control-label'>password</label>
                  <div class='col-sm-8'>
                    <input class='form-control passowrd pass_log_id' type='password' name='pass' autocomplete='new-password' required='required'/>
                    <i class="showpass togglePassword far fa-solid fa-eye-slash" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                  </div>
              </div>
              <div  class='form-group row'>
                  <label class= 'col-sm-1 control-label'>Email</label>
                  <div class='col-sm-8'>
                    <input class='form-control' type='email' name='email' />
                  </div>
              </div>
              <div  class='form-group row'>
                  <label class= 'col-sm-1 control-label'>Fullname</label>
                  <div class='col-sm-8'>
                    <input class='form-control' type='text' name='full' />
                  </div>
              </div>
              <div  class='form-group row'>
                   <label class= 'col-sm-1 control-label'></label>
                   <div class='col-sm-8'>
                    <input class='btn btn-primary btn-block' type='submit' value='add' />
                  </div>
              </div>
            </form>
          </div>
  <?php 
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
