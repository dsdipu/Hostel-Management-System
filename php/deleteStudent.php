<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../Admin/adminLogin.php");
    exit();
}
include "dbConnect.php";

$id = $_POST['student_id'];
$room = $_POST['room_id'];

// student কে ডিলিট মার্ক করো (পুরোপুরি মুছো না)
$connect->query("UPDATE students SET deleted_at = NOW() WHERE student_id = '$id'");

// room এর occupancy কমাও
$connect->query("UPDATE rooms SET occupancy = occupancy - 1 WHERE room_id = '$room'");

// ফিরে যাও student list এ
header("Location: ../Admin/adminStudents.php");
exit();
?>