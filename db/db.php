<?php
$host = 'db';
$dbname = 'cykor_web1_db';
$user = 'root';
$pass = 'racon123!'; 

$connection = new mysqli($host, $user, $pass, $dbname); // mysql 접속 

if ($connection->connect_error) {
    die("Connect error: " . $connection->connect_error); //에러 발생시 출력 
}
?>
