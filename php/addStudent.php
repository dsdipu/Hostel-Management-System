<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../Admin/adminLogin.php");
    exit();
}
include "dbConnect.php";

$name = $_POST['studentName'];
$dept = $_POST['department'];
$phone = $_POST['phone'];
$roomNumber = $_POST['roomID'];

// Auto generate Student ID (small letter s)
$prefix = "s";
$year = date("y");
$lastIdQuery = $connect->query("SELECT student_id FROM students ORDER BY student_id DESC LIMIT 1");
if ($lastIdQuery->num_rows > 0) {
    $lastId = $lastIdQuery->fetch_assoc()['student_id'];
    $lastNum = intval(substr($lastId, -4));
    $newNum = str_pad($lastNum + 1, 4, "0", STR_PAD_LEFT);
} else {
    $newNum = "0001";
}
$student_id = $prefix . $year . $newNum;

// room_number থেকে room_id বের করো
$roomFind = $connect->query("SELECT room_id, capacity, occupancy FROM rooms WHERE room_number = '$roomNumber'");
$roomData = $roomFind->fetch_assoc();

if ($roomData) {
    $room_id = $roomData['room_id'];
    $capacity = $roomData['capacity'];
    $occupancy = $roomData['occupancy'];
    
    if ($occupancy < $capacity) {
        $sql = "INSERT INTO students (student_id, name, department, phone, room_id, password, created_at) 
                VALUES ('$student_id', '$name', '$dept', '$phone', '$room_id', '', NOW())";
        
        if ($connect->query($sql) === TRUE) {
            $connect->query("UPDATE rooms SET occupancy = occupancy + 1 WHERE room_id = '$room_id'");
            echo "<script>alert('Student added successfully! Student ID: $student_id'); window.location='../Admin/adminStudents.php';</script>";
        } else {
            echo "Error: " . $connect->error;
        }
    } else {
        echo "<script>alert('Room full! Capacity: $capacity, Occupancy: $occupancy'); window.location='../Admin/adminStudents.php';</script>";
    }
} else {
    echo "<script>alert('Room Number $roomNumber not found'); window.location='../Admin/adminStudents.php';</script>";
}

$connect->close();
?>