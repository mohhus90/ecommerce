<?php
      session_start();
      $title = 'Manage User';
      
      
    if(isset($_SESSION['username'])){
        //   header('location: dashboard.php');
          // echo '<h1>Welcome to Dashboard </h1>' . $_SESSION['username'];
          include "init.php";
          $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
    
          if($do=='manage'){
           
            $stmt = $con->prepare("SELECT * FROM users ");
            $stmt->execute(array());
            $rows = $stmt->fetchall();
            
            ?>
        <h1 class='text-center'>Manage User</h1>
          <div class= 'container'>
            <div class='table-responsive'>
              <table class= 'table table-bordered thead-dark main-table text-center' >
              
                <tr style="border-color:blue;" >
                  <td>#ID</td>
                  <td>Username</td>
                  <td>Email</td>
                  <td>Fullname</td>
                  <td>Register date</td>
                  <td>control</td>
                </tr>
              
                <?php
                
                   foreach($rows as $row) {


                    echo '<tr style="border-color:rgb(124, 114, 114);" >';
                    echo '<td style="border-color:rgb(124, 114, 114);">'.$row['userid'].'</td>';
                    echo '<td style="border-color:rgb(124, 114, 114);">'.$row['username'].'</td>';
                    echo '<td style="border-color:rgb(124, 114, 114);">'.$row['email'].'</td>';
                    echo '<td style="border-color:rgb(124, 114, 114);">'.$row['fullname'].'</td>';
                    echo '<td style="border-color:rgb(124, 114, 114);">'.$row['regdate'].'</td>';
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
            <a href="member.php?do=add" class='btn btn-primary'><i class="fa fa-plus" ></i> New Member</a>
          </div>
        <?php
        }elseif($do=='add'){?>

          <h1 class='text-center'>Add User</h1>
          <div class= 'loginedit'>  
            <form class= 'form-horizontal' action="?do=insert" method="POST">
            
              <div  class='form-group'>
                  <label class= 'col-sm-2 control-label'>username</label>
                  <div class='col-sm-8'>
                    <input class='form-control' type='text' name='user' required='required' autocomplete='off' />
                  </div>
              </div>
              <div  class='form-group'>
                  <label class= 'col-sm-2 control-label'>password</label>
                  <div class='col-sm-8'>
                    <input class='form-control passowrd' id="pass_log_id" type='password' name='pass' autocomplete='new-password' required='required'/>
                    <!-- <i class='showpass fa fa-eye fa-1x'></i> -->
                    <i class="showpass togglePassword tog far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                  </div>
              </div>
              <div  class='form-group'>
                  <label class= 'col-sm-2 control-label'>Email</label>
                  <div class='col-sm-8'>
                    <input class='form-control' type='email' name='email' />
                  </div>
              </div>
              <div  class='form-group'>
                  <label class= 'col-sm-2 control-label'>Fullname</label>
                  <div class='col-sm-8'>
                    <input class='form-control' type='text' name='full' />
                  </div>
              </div>
              <div  class='form-group'>
                   <label class= 'col-sm-2 control-label'></label>
                   <div class='col-sm-8'>
                    <input class='btn btn-primary btn-block' type='submit' value='add' />
                  </div>
              </div>
            </form>
          </div>
  <?php }elseif($do=='insert'){

            if($_SERVER['REQUEST_METHOD']=='POST'){
                  $user= $_POST['user'];
                  $full= $_POST['full'];
                  $email= $_POST['email'];
                  $password = $_POST['pass'];
                  $hashpass = SHA1('$password');

                  $erorrarray = array();
                  if(empty($user)){
                    $erorrarray[]=  "you can't set username empty";
                  }
                  // if(empty($full)){
                  //   $erorrarray[]=  "you can't set fullname empty";
                  // }
                  // if(empty($email)){
                  //   $erorrarray[]=  "you can't set Email empty";
                  // }
                  
                  foreach($erorrarray as $erorr){
                    echo '<div class="alert alert-danger text-center">'. $erorr .'</div>';
                  }
                
                  if(empty($erorrarray)){
                    $cheked= checkitem('username','users',$user);
                        // $stmt = $con->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
                        // $stmt->execute(array($user));
                        // $row = $stmt->fetch();
                        // $count= $stmt->rowCount();
                  

                        if($cheked >0){ 
                          $errmsg = '<div class="alert alert-danger text-center d-flex justify-content-center">'. 'This user is already exist' .'</div>';
                          redirect($errmsg,'back');

                        }else{
                              $stmt = $con->prepare("INSERT INTO users (username,fullname,email,password,regdate,regstatus) VALUES(?,?,?,?,now(),1)");
                              $stmt->execute(array($user,$full,$email,$hashpass));
                              $count= $stmt->rowCount();
                              redirect($count .' '. 'Record Succesfully Inserted' ,3);
                        }
                  }
                  
              
            }else{
              echo 'sorry';
            }


            }elseif($do=='edit'){
              $userid=isset($_GET['userid']) && is_numeric($_GET['userid'])? intval($_GET['userid']):0;
                  $stmt = $con->prepare("SELECT * FROM users WHERE userid = ? LIMIT 1");
                  $stmt->execute(array($userid));
                  $row = $stmt->fetch();
                  $count= $stmt->rowCount();
                  if($count >0){ 
                          $passrow=$row['password'];?>

                          <h1 class='text-center'>Edit User</h1>
                          <div class= 'loginedit'>  
                            <form class= 'form-horizontal' action="?do=update" method="POST">
                            <input  type='hidden' value="<?php echo $row['userid']?>" name='userid' />
                              <div  class='form-group'>
                                  <label class= 'col-sm-2 control-label'>username</label>
                                  <div class='col-sm-8'>
                                    <input class='form-control' type='text' value="<?php echo $row['username']?>" name='user' required='required' autocomplete='off' />
                                  </div>
                              </div>
                              <div  class='form-group'>
                                  <label class= 'col-sm-2 control-label'>password</label>
                                  <div class='col-sm-8'>
                                    <input class='form-control' type='password' name='pass' autocomplete='new-password' />
                                  </div>
                              </div>
                              <div  class='form-group'>
                                  <label class= 'col-sm-2 control-label'>Email</label>
                                  <div class='col-sm-8'>
                                    <input class='form-control' type='email' value="<?php echo $row['email']?>" name='email' />
                                  </div>
                              </div>
                              <div  class='form-group'>
                                  <label class= 'col-sm-2 control-label'>Fullname</label>
                                  <div class='col-sm-8'>
                                    <input class='form-control' type='text' value="<?php echo $row['fullname']?>" name='full' />
                                  </div>
                              </div>
                              <div  class='form-group'>
                              <label class= 'col-sm-2 control-label'></label>
                                  <div class='col-sm-8'>
                                    <input class='btn btn-primary btn-block' type='submit' value='save' />
                                  </div>
                              </div>
                            </form>
                          </div>
                          <?php }else{
                                    echo 'there is no user';
                                  }
            }elseif($do=='update'){
              echo "<h1 class='text-center'>Update User</h1>";
              
              if($_SERVER['REQUEST_METHOD']=='POST'){
                $id= $_POST['userid'];
                $user= $_POST['user'];
                $full= $_POST['full'];
                $email= $_POST['email'];
                $password = $_POST['pass'];
                $hashedpass='';
                    if(empty($password)){
                      $stmt = $con->prepare("SELECT password FROM users WHERE userid = ? LIMIT 1");
                      $stmt->execute(array($id));
                      $row = $stmt->fetch();
                      $count= $stmt->rowCount();
                      $passrow=$row['password'];
                      $hashedpass=$passrow;
                      
                    }else{
                      $hashedpass = SHA1('$password');
                      
                    }
                    $erorrarray = array();
                    if(empty($user)){
                      $erorrarray[]=  "you can't set username empty";
                    }
                    if(empty($full)){
                      $erorrarray[]=  "you can't set fullname empty";
                    }
                    if(empty($email)){
                      $erorrarray[]=  "you can't set Email empty";
                    }
                    
                    foreach($erorrarray as $eror){
                    
                      echo $eror . '<br>';
                    }
                  
                    if(empty($erorrarray)){
                      $stmt = $con->prepare("UPDATE users SET username = ?, fullname = ?, email =?, password=? where userid= ?");
                      $stmt->execute(array($user,$full,$email,$hashedpass,$id));
                      $count= $stmt->rowCount();
                      echo $count .' '. 'Record Succesfully Updated';
                      redirect($count .' '. 'Record Succesfully Updated' ,6);
                    }
                    
                
              }else{
                redirect('you canot browse this page directly' ,3);
              }

            }elseif($do=='delete'){
              echo "<h1 class='text-center'>Delete User</h1>";
              $userid=isset($_GET['userid']) && is_numeric($_GET['userid'])? intval($_GET['userid']):0;
                  $stmt = $con->prepare("DELETE FROM users WHERE userid = ? LIMIT 1");
                  $stmt->execute(array($userid));
                  $count= $stmt->rowCount();
                  redirect($count .' '. 'Record Succesfully Deleted' ,3);
            }     

          include $tmpl."footer.php";
      }
      else{
        redirect('Sorry you not have authorized' , 3);
        
        
      }
      
?>
