<?php
    session_start();
    $nonavbar = '';
    $title = 'login';
    if(isset($_SESSION['username'])){
        header('location: dashboard.php');
    }
    // print_r($_SESSION);
    include "init.php";
    

     
?>
<!-- <div class="btn btn-danger btn-block">test</div>
<i class="fa-solid fa-house fa-5x"></i>
<i class="fa-regular fa-house fa-5x"></i>
<i class="fa-duotone fa-house"></i>
<h1> Welcome to Ecommerce</h1>
<?php echo lang('message'). ' '. lang('admin')?>--> 

<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $hashpass = SHA1('$password');

        $stmt = $con->prepare("SELECT userid, username, password FROM users WHERE username = ? AND password= ? LIMIT 1");
        $stmt->execute(array($username, $hashpass));
        $row = $stmt->fetch();
        $count= $stmt->rowCount();
        if($count >0){
            $_SESSION['username'] = $username;
            $_SESSION['ID'] =$row['userid'];
            header('location: dashboard.php');
        }
        else{
            echo 'You are not authorized';
        }
        
    }
?>
    <form  class='login' style="color:BLUE" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <div class= 'text-center'>Go Partner's</div>
        <input class='form-control' type='username' name='user' placeholder='username' autocomplete='off' />
        <input class='form-control' type='password' name='pass' placeholder='password' autocomplete='newpassword' />
        <input class='btn btn-primary btn-block' type='submit'  name='login' />
    </form>

<?php
    include $tmpl."footer.php";
?>