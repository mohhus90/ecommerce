<?php
    $dsn= 'mysql:host=localhost;dbname=shop';
    $user= 'root';
    $pass = '';
    $option = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );
    try {
        $con = new PDO($dsn , $user, $pass , $option);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmn = $con->prepare("CREATE TABLE IF NOT EXISTS users (
            userid int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            username varchar(100) NOT NULL,
            email varchar(100) NOT NULL,
            password varchar(100) NOT NULL,
            fullname varchar(100) NOT NULL,
            groupid int(11) NOT NULL DEFAULT 0,
            regstatus int(11) NOT NULL DEFAULT 0,
            regdate datetime NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");
        
        $stmn->execute();
       
        $stmnts= $con->prepare("SELECT username FROM users WHERE username= ?");
        $stmnts->execute(array('hus'));
        $count = $stmnts->rowCount();
        echo $count;
        if($count==0){
                $stmnt = $con->prepare("INSERT INTO users (username,fullname,password,regdate,regstatus) VALUES(?,?,?,now(),1)");
                $stmnt->execute(array('hus','hus','506da6907f960f50cad09ca45512519f91515237'));
        }	
    }
    catch (PDOException $e){
        echo 'failed to connect' . $e->getMessage();
    }

        