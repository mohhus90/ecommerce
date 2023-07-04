<?php
      session_start();
      $title = 'Edit User';
      
      
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
          <div class= 'loginedit'>
            <div class='table-responsive'>
              <table class= 'table table-bordered main-table text-center'>
                <tr>
                  <td>#ID</td>
                  <td>Username</td>
                  <td>Email</td>
                  <td>Fullname</td>
                  <td>Register date</td>
                  <td>control</td>
                </tr>
                <?php
                
                   foreach($rows as $row) {
                    echo '<tr>';
                    echo '<td>'.$row['userid'].'</td>';
                    echo '<td>'.$row['username'].'</td>';
                    echo '<td>'.$row['email'].'</td>';
                    echo '<td>'.$row['fullname'].'</td>';
                    echo '<td>'.''.'</td>';
                    echo '<td>';
                    echo '<a href="#" class="btn btn-success">Edit</a>';
                    echo '<a href="#" class="btn btn-danger">Delete</a>';
                    echo '</td>';
                    echo '</tr>';
                  } 
                  
                ?>
                  

              </table>
            </div>
            <a href="member.php?do=add" class='btn btn-primary'><i class="fa fa-plus" ></i>Add new member</a>
          </div>
        <?php
        }elseif($do=='add'){?>

          <h1 class='text-center'>Add User</h1>
          <div class= 'loginedit'>  
            <form class= 'form-horizontal' action="?do=insert" method="POST">
            
              <div  class='form-group'>
                  <label class= 'col-sm-2 control-label'>username</label>
                  <div class='col-sm-6'>
                    <input class='form-control' type='text' name='user' required='required' autocomplete='off' />
                  </div>
              </div>
              <div  class='form-group'>
                  <label class= 'col-sm-2 control-label'>password</label>
                  <div class='col-sm-6'>
                    <input class='form-control' type='password' name='pass' autocomplete='new-password' required='required'/>
                  </div>
              </div>
              <div  class='form-group'>
                  <label class= 'col-sm-2 control-label'>Email</label>
                  <div class='col-sm-6'>
                    <input class='form-control' type='email' name='email' />
                  </div>
              </div>
              <div  class='form-group'>
                  <label class= 'col-sm-2 control-label'>Fullname</label>
                  <div class='col-sm-6'>
                    <input class='form-control' type='text' name='full' />
                  </div>
              </div>
              <div  class='form-group'>
                  <div class='col-sm-offeset-2 col-sm-6'>
                    <input class='btn btn-primary col-sm-6' type='submit' value='add' />
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
                  if(empty($full)){
                    $erorrarray[]=  "you can't set fullname empty";
                  }
                  if(empty($email)){
                    $erorrarray[]=  "you can't set Email empty";
                  }
                  
                  foreach($erorrarray as $erorr){
                    echo '<div class="alert alert-danger text-center">'. $erorr .'</div>';
                  }
                
                  if(empty($erorrarray)){
                    $stmt = $con->prepare("INSERT INTO users (username,fullname,email,password) VALUES(?,?,?,?)");
                    $stmt->execute(array($user,$full,$email,$hashpass));
                    $count= $stmt->rowCount();
                    echo $count .' '. 'Record Succesfully Inserted';
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
                                  <div class='col-sm-6'>
                                    <input class='form-control' type='text' value="<?php echo $row['username']?>" name='user' required='required' autocomplete='off' />
                                  </div>
                              </div>
                              <div  class='form-group'>
                                  <label class= 'col-sm-2 control-label'>password</label>
                                  <div class='col-sm-6'>
                                    <input class='form-control' type='password' name='pass' autocomplete='new-password' />
                                  </div>
                              </div>
                              <div  class='form-group'>
                                  <label class= 'col-sm-2 control-label'>Email</label>
                                  <div class='col-sm-6'>
                                    <input class='form-control' type='email' value="<?php echo $row['email']?>" name='email' />
                                  </div>
                              </div>
                              <div  class='form-group'>
                                  <label class= 'col-sm-2 control-label'>Fullname</label>
                                  <div class='col-sm-6'>
                                    <input class='form-control' type='text' value="<?php echo $row['fullname']?>" name='full' />
                                  </div>
                              </div>
                              <div  class='form-group'>
                                  <div class='col-sm-offeset-2 col-sm-6'>
                                    <input class='btn btn-primary col-sm-6' type='submit' value='save' />
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
                    
                    foreach($erorrarray as $erorr){
                      echo '<div class="alert alert-danger text-center">'. $erorr .'</div>';
                    }
                  
                    if(empty($erorrarray)){
                      $stmt = $con->prepare("UPDATE users SET username = ?, fullname = ?, email =?, password=? where userid= ?");
                      $stmt->execute(array($user,$full,$email,$hashedpass,$id));
                      $count= $stmt->rowCount();
                      echo $count .' '. 'Record Succesfully Updated';
                    }
                    
                
              }else{
                echo 'sorry';
              }

            }

          include $tmpl."footer.php";
      }
      else{
        header('location: index.php');
        exit();
        
      }
      
?>
