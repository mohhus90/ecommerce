<?php
ob_start();
$servername = "localhost";//localhost
$user = "root";//root
$pass = ""; //""
try {
    $conn = new PDO("mysql:host=$servername;", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $dbname = "shop";
    $createDbQuery = "CREATE DATABASE IF NOT EXISTS $dbname";
    $conn->exec($createDbQuery);
    

    
} catch(PDOException $e) {
    echo "Error creating database: " . $e->getMessage();
}

$dsn = 'mysql:host='.$servername.';dbname=shop;charset=utf8mb4';//localhost
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
);
try {
    $con = new PDO($dsn, $user, $pass, $options);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->exec("SET time_zone='+03:00';");
    $st = $con->prepare("CREATE TABLE IF NOT EXISTS users (
        userid int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        username varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
        email varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
        password varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
        fullname varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
        groupid int(11) NOT NULL DEFAULT 0,
        regstatus int(11) NOT NULL DEFAULT 0,
        regdate datetime NOT NULL,
        UNIQUE KEY `username` (`username`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");
    $st2 = $con->prepare("CREATE TABLE IF NOT EXISTS `items` (
        `itemid` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `name` varchar(100) NOT NULL,
        `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
        `cost` float NOT NULL,
        `add_date` datetime NOT NULL,
        `quantity` float NOT NULL,
        `unit` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
        `user_id` int(11) NOT NULL,
        UNIQUE KEY `name` (`name`),
        KEY `user` (`user_id`),
        CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`userid`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");
    $st3 = $con->prepare("CREATE TABLE IF NOT EXISTS `partners` (
        `partid` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `part_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
        `com_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
        `reg_no` int(20) NOT NULL,
        `tax_no` int(20) NOT NULL,
        `add_date` datetime NOT NULL,
        `mod_date` datetime NOT NULL,
        `user_id` int(11) NOT NULL,
        UNIQUE KEY `uk_part_name` (`part_name`),
        UNIQUE KEY `uk_reg_no` (`reg_no`),
        UNIQUE KEY `uk_tax_no` (`tax_no`),
        KEY `idx_user_id` (`user_id`),
        CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`userid`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");
    $st->execute();
    $st2->execute();
    $st3->execute();
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
ob_end_flush();
?>

<?php
// ob_start();
// $servername = "sql208.unaux.com";//localhost
// $username = "unaux_34610376";//root
// $password = "HusHus@4218"; //""
// try {
//     $conn = new PDO("mysql:host=$servername;", $username, $password);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     $dbname = "unaux_34610376_shop";
//     $createDbQuery = "CREATE DATABASE IF NOT EXISTS $dbname";
//     $conn->exec($createDbQuery);
    

    
// } catch(PDOException $e) {
//     echo "Error creating database: " . $e->getMessage();
// }

// $dsn = 'mysql:host=sql208.unaux.com;dbname=unaux_34610376_shop;charset=utf8mb4';//localhost
// $user = 'unaux_34610376';//root
// $pass = 'HusHus@4218';//""
// $options = array(
//     PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4',
// );
// try {
//     $con = new PDO($dsn, $user, $pass, $options);
//     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     $con->exec("SET time_zone='+03:00';");
//     $st = $con->prepare("CREATE TABLE IF NOT EXISTS users (
//         userid int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
//         username varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
//         email varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
//         password varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
//         fullname varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
//         groupid int(11) NOT NULL DEFAULT 0,
//         regstatus int(11) NOT NULL DEFAULT 0,
//         regdate datetime NOT NULL,
//         UNIQUE KEY `username` (`username`)
//     ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");
//     $st2 = $con->prepare("CREATE TABLE IF NOT EXISTS `items` (
//         `itemid` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
//         `name` varchar(100) NOT NULL,
//         `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
//         `cost` float NOT NULL,
//         `add_date` datetime NOT NULL,
//         `quantity` float NOT NULL,
//         `unit` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
//         `user_id` int(11) NOT NULL,
//         UNIQUE KEY `name` (`name`),
//         KEY `user` (`user_id`),
//         CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`userid`)
//         ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;");
    //     $st3 = $con->prepare("CREATE TABLE IF NOT EXISTS `partners` (
    //     `partid` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    //     `part_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    //     `com_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    //     `reg_no` int(20) NOT NULL,
    //     `tax_no` int(20) NOT NULL,
    //     `add_date` datetime NOT NULL,
    //     `mod_date` datetime NOT NULL,
    //     `user_id` int(11) NOT NULL,
    //     UNIQUE KEY `uk_part_name` (`part_name`),
    //     UNIQUE KEY `uk_reg_no` (`reg_no`),
    //     UNIQUE KEY `uk_tax_no` (`tax_no`),
    //     KEY `idx_user_id` (`user_id`),
    //     CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`userid`)
    // ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;");
    // $st->execute();
    // $st2->execute();
    // $st3->execute();
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
// ob_end_flush();
?>

