<?php
$servername = "localhost";
$username = "root";
$password = ""; // Replace with your MySQL password

try {
    $conn = new PDO("mysql:host=$servername;", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dbname = "shop";
    $createDbQuery = "CREATE DATABASE IF NOT EXISTS $dbname";
    $conn->exec($createDbQuery);

    
} catch(PDOException $e) {
    echo "Error creating database: " . $e->getMessage();
}

$dsn = 'mysql:host=localhost;dbname=shop;charset=utf8mb4';
$user = 'root';
$pass = '';
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
);
try {
    $con = new PDO($dsn, $user, $pass, $options);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $st = $con->prepare("CREATE TABLE IF NOT EXISTS users (
        userid int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        username varchar(100) NOT NULL,
        email varchar(100) NOT NULL,
        password varchar(100) NOT NULL,
        fullname varchar(100) NOT NULL,
        groupid int(11) NOT NULL DEFAULT 0,
        regstatus int(11) NOT NULL DEFAULT 0,
        regdate datetime NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
    
    $st->execute();

    $stmnt = $con->prepare("SELECT username FROM users WHERE username = ?");
    $stmnt->execute(array('hus'));
    $count = $stmnt->rowCount();
    
    if ($count == 0) {
        $stmnt = $con->prepare("INSERT INTO users (username, fullname, password, regdate, regstatus) VALUES (?, ?, ?, NOW(), 1)");
        $stmnt->execute(array('hus', 'hus', '506da6907f960f50cad09ca45512519f91515237'));
    }	
} catch (PDOException $e) {
    echo 'Failed to connect: ' . $e->getMessage();
}


// $dbname = 'shop';
// $conn = mysqli_connect('localhost', 'root', '');
// if (!$conn) {
//     die('Could not connect: ' . mysqli_connect_error());
// }

// if (mysqli_select_db($conn, $dbname)) {
//     echo "Database $dbname already exists.";
// } else {
//     if (mysqli_query($conn, "CREATE DATABASE $dbname")) {
//         echo "Database $dbname created.";
//     } else {
//         echo "Error creating database: " . mysqli_error($conn);
//     }
// }

// mysqli_close($conn);

// $dsn = 'mysql:host=localhost;dbname=shop';
// $user = 'root';
// $pass = '';
// $options = array(
//     PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
// );
// try {
//     $con = new PDO($dsn, $user, $pass, $options);
//     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $st = $con->prepare("CREATE TABLE IF NOT EXISTS users (
//         userid int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
//         username varchar(100) NOT NULL,
//         email varchar(100) NOT NULL,
//         password varchar(100) NOT NULL,
//         fullname varchar(100) NOT NULL,
//         groupid int(11) NOT NULL DEFAULT 0,
//         regstatus int(11) NOT NULL DEFAULT 0,
//         regdate datetime NOT NULL
//     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");
    
//     $st->execute();

//     $stmnt = $con->prepare("SELECT username FROM users WHERE username = ?");
//     $stmnt->execute(array('hus'));
//     $count = $stmnt->rowCount();
    
//     if ($count == 0) {
//         $stmnt = $con->prepare("INSERT INTO users (username, fullname, password, regdate, regstatus) VALUES (?, ?, ?, NOW(), 1)");
//         $stmnt->execute(array('hus', 'hus', '506da6907f960f50cad09ca45512519f91515237'));
//     }	
// } catch (PDOException $e) {
//     echo 'Failed to connect: ' . $e->getMessage();
// }


//     $dbname = 'shop';
//     $conn = mysql_connect('localhost','root','');
//     if (!$conn)
//     {
//         die('Could not connect: ' . mysql_error());
//     }
// if (mysql_num_rows(mysql_query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '". $dbname ."'"))) {
//         echo "Database $dbname already exists.";
//     }
//     else {
//         mysql_query("CREATE DATABASE '". $dbname ."'",$conn);
//         echo "Database $dbname created.";
//     }

//     $dsn= 'mysql:host=localhost;dbname=shop';
//     $user= 'root';
//     $pass = '';
//     $option = array(
//         PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
//     );
//     try {
//         $con = new PDO($dsn , $user, $pass , $option);
//         $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         $st = $con->prepare("CREATE DATABASE IF NOT EXISTS shop;");
//         $st->execute();

//         $stmn = $con->prepare("CREATE TABLE IF NOT EXISTS users (
//             userid int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
//             username varchar(100) NOT NULL,
//             email varchar(100) NOT NULL,
//             password varchar(100) NOT NULL,
//             fullname varchar(100) NOT NULL,
//             groupid int(11) NOT NULL DEFAULT 0,
//             regstatus int(11) NOT NULL DEFAULT 0,
//             regdate datetime NOT NULL
//         ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");
        
//         $stmn->execute();
       
//         $stmnts= $con->prepare("SELECT username FROM users WHERE username= ?");
//         $stmnts->execute(array('hus'));
//         $count = $stmnts->rowCount();
        
//         if($count==0){
//                 $stmnt = $con->prepare("INSERT INTO users (username,fullname,password,regdate,regstatus) VALUES(?,?,?,now(),1)");
//                 $stmnt->execute(array('hus','hus','506da6907f960f50cad09ca45512519f91515237'));
//         }	
//     }
//     catch (PDOException $e){
//         echo 'failed to connect' . $e->getMessage();
//     }

        