<?php
$connect = new mysqli("127.0.0.1", "root", "", "hostelMS");
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>