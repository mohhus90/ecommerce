<?php
      ob_start();
      session_start();
      $title = 'Items';    
    if(isset($_SESSION['username'])){
        include "init.php";
        $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
            if($do=='manage'){
              
              $stmt = $con->prepare("SELECT * FROM partners INNER JOIN users ON partners.user_id = users.userid;");
              $stmt->execute(array());
              $rows = $stmt->fetchall();
              
              ?>
          <h1 class='text-center'><i class="fa fa-handshake icon"></i> Manage Partners</h1>
            <div class= 'container'>
              <div class='table-responsive'>
                <table class= 'table table-bordered thead-dark main-table text-center' >
                
                  <tr style="border-color:blue;" >
                    <td>#ID</td>
                    <td>partners</td>
                    <td>company name</td>
                    <td>registration no</td>
                    <td>tax no</td>
                    <td>username</td>
                    <td>add date</td>
                    <td>modify date</td>
                    <td>Control</td>
                  </tr>
                  <?php
                     foreach($rows as $row) {
                      echo '<tr style="border-color:rgb(124, 114, 114);" >';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['partid'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['part_name'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['com_name'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['reg_no'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['tax_no'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['username'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['add_date'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">'.$row['mod_date'].'</td>';
                      echo '<td style="border-color:rgb(124, 114, 114);">';
                      echo '<a href="partners.php?do=edit&partid='. $row['partid'].'" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>';
                      echo ' ';
                      echo '<a href="partners.php?do=delete&partid='. $row['partid'].'" class="btn btn-danger confirm"><i class="fa fa-close"></i> Delete</a>';
                      echo ' ';
                      if($row['regstatus']==0){
                        echo '<a href="partners.php?do=active&partid='. $row['partid'].'" class="btn btn-info "><i class="fa fa-check"></i> active</a>';
                      }
                      echo '</td>';
                      echo '</tr>';
                    } 
                    
                  ?>
                    
  
                </table>
              </div>
              <a href="partners.php?do=add" class='btn btn-primary'><i class="fa fa-plus icon" ></i> New Item</a>
            </div>
          <?php
        }elseif($do=='add'){?>
            <h1 class='text-center'><i class="fa fa-handshake icon"></i> Add Partner</h1>
          <div class= ' container'>  
            <form class= 'justify-content-center col-sm-9' action="?do=insert" method="POST">
            
              <div  class='form-group row'>
              <label class= 'col-sm-2 control-label'></label>
                  <label class= 'col-sm-2 control-label'>partner</label>
                  <div class='col-sm-8'>
                    <input class='form-control' type='text' name='partner' required='required' />
                  </div>
              </div>
              <div  class='form-group row'>
              <label class= 'col-sm-2 control-label '></label>
                  <label class= 'col-sm-2 control-label'>company name</label>
                  <div class='col-sm-8'>
                    <input class='form-control' type='text' name='com_name' />
                  </div>
              </div>
              <div  class='form-group row'>
              <label class= 'col-sm-2 control-label'></label>
                  <label class= 'col-sm-2 control-label'>registration no</label>
                  <div class='col-sm-8'>
                    <input class='form-control' type='text' name='reg_no' required='required'/>
                  </div>
              </div>
              <div  class='form-group row'>
              <label class= 'col-sm-2 control-label'></label>
                  <label class= 'col-sm-2 control-label'>tax no</label>
                  <div class='col-sm-8'>
                    <input class='form-control' type='text' name='tax_no' required='required'/>
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
                $partner= $_POST['partner'];
                $com_name= $_POST['com_name'];
                $reg_no= $_POST['reg_no'];
                $tax_no= $_POST['tax_no'];
                $userid = $_SESSION['ID'];
                  $cheked= checkitem('part_name','partners',$partner);
                      if($cheked >0){ 
                        $errmsg = '<div class="alert alert-danger text-center d-flex justify-content-center">'. 'This partner is already exist' .'</div>';
                        redirect($errmsg,'back');

                      }else{$stmt = $con->prepare("SELECT * FROM partners WHERE part_name = ? OR reg_no=? OR tax_no=? LIMIT 1");
                        $stmt->execute(array($partner,$reg_no,$tax_no));
                        $row = $stmt->fetch();
                        $cheked= $stmt->rowCount();
                        if($cheked == 0){
                            $stmt = $con->prepare("INSERT INTO partners (part_name,com_name,reg_no,tax_no,user_id,add_date,mod_date) VALUES(?,?,?,?,?,now(),now())");
                            $stmt->execute(array($partner,$com_name,$reg_no,$tax_no,$userid));
                            $count= $stmt->rowCount();
                            $errmsg= '<div class="alert alert-success col-md-6 container text-center d-flex align-items-center justify-content-center">'.$count .' '. ' Record Succesfully Inserted</div>';
                            redirect($errmsg,'back');
                          }else{
                            $errmsg= '<div class="alert alert-danger col-md-6 container text-center d-flex align-items-center justify-content-center">This partner is already exist</div>';
                            redirect($errmsg, 'back',4);
                          }
                      }
                }else{
                  $errmsg = '<div class="alert alert-danger text-center d-flex justify-content-center">'. 'You can not request directly' .'</div>';
                  redirect($errmsg,'back');

                }
        }elseif($do=='edit'){
              $partid=isset($_GET['partid']) && is_numeric($_GET['partid'])? intval($_GET['partid']):0;
                  $stmt = $con->prepare("SELECT * FROM partners WHERE partid = ? LIMIT 1");
                  $stmt->execute(array($partid));
                  $row = $stmt->fetch();
                  $count= $stmt->rowCount();
                  if($count >0){?>
                          <h1 class='text-center'><i class="fa fa-handshake icon"></i> Edit Partner</h1>
                          <div class= ' container'>  
                            <form class= 'justify-content-center col-sm-9' action="?do=update" method="POST">
                            <input  type='hidden' value="<?php echo $row['partid']?>" name='partid' />
                              <  <div  class='form-group row'>
                          <label class= 'col-sm-2 control-label'></label>
                              <label class= 'col-sm-2 control-label'>partner</label>
                              <div class='col-sm-8'>
                                <input class='form-control' type='text' value="<?php echo $row['part_name']?>"  name='partner' required='required' />
                              </div>
                                </div>
                                <div  class='form-group row'>
                                <label class= 'col-sm-2 control-label '></label>
                                    <label class= 'col-sm-2 control-label'>company name</label>
                                    <div class='col-sm-8'>
                                      <input class='form-control' type='text' value="<?php echo $row['com_name']?>" name='com_name' />
                                    </div>
                                </div>
                                <div  class='form-group row'>
                                <label class= 'col-sm-2 control-label'></label>
                                    <label class= 'col-sm-2 control-label'>registration no</label>
                                    <div class='col-sm-8'>
                                      <input class='form-control' type='text' value="<?php echo $row['reg_no']?>"  name='reg_no' required='required'/>
                                    </div>
                                </div>
                                <div  class='form-group row'>
                                <label class= 'col-sm-2 control-label'></label>
                                    <label class= 'col-sm-2 control-label'>tax no</label>
                                    <div class='col-sm-8'>
                                      <input class='form-control' type='text' value="<?php echo $row['tax_no']?>"  name='tax_no' required='required'/>
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
                $id=  $_POST['partid'];
                $partner= $_POST['partner'];
                $com_name= $_POST['com_name'];
                $reg_no= $_POST['reg_no'];
                $tax_no= $_POST['tax_no'];
                $userid = $_SESSION['ID'];
                $stmt = $con->prepare("SELECT * FROM partners WHERE partid != ? and part_name = ? OR partid != ? and reg_no=? OR partid != ? and tax_no= ?  LIMIT 1");
                        $stmt->execute(array($id,$partner,$id,$reg_no,$id,$tax_no));
                        $row = $stmt->fetch();
                        $cheked= $stmt->rowCount();
                        if($cheked == 0){
                            $stmt = $con->prepare("UPDATE partners SET part_name = ?, com_name = ?, reg_no =?, tax_no=?, user_id=?, mod_date=now() where partid= ?");
                            $stmt->execute(array($partner,$com_name,$reg_no,$tax_no,$userid,$id));
                            $count= $stmt->rowCount();
                            $errmsg= '<div class="alert alert-success col-md-6 container text-center d-flex align-items-center justify-content-center">'.$count .' '. ' Record Succesfully Updated</div>';
                            redirect($errmsg,'items.php');
                          }else{
                            $errmsg= '<div class="alert alert-danger col-md-6 container text-center d-flex align-items-center justify-content-center">This partner is already exist</div>';
                            redirect($errmsg, 'back',4);
                          }
                }else{
                  $errmsg= '<div class="alert alert-success col-md-6 container text-center d-flex align-items-center justify-content-center">you canot browse this page directly</div>';
                  redirect($errmsg);
                }

        }elseif($do=='delete'){
          echo "<h1 class='text-center'>Delete Item</h1>";
              $partid=isset($_GET['partid']) && is_numeric($_GET['partid'])? intval($_GET['partid']):0;
                  $stmt = $con->prepare("DELETE FROM partners WHERE partid = ? LIMIT 1");
                  $stmt->execute(array($partid));
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
