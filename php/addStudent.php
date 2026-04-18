<?php
include "dbConnect.php";

$id = $_POST['studentID'];
$name = $_POST['studentName'];
$dept = $_POST['department'];
$phone = $_POST['phone'];
$room = $_POST['roomID'];

$sql = "INSERT INTO students (student_id, name, department, phone, room_id, password) 
        VALUES ('$id', '$name', '$dept', '$phone', '$room', '')";

if ($connect->query($sql) === TRUE) {
    header("Location: ../Admin/adminStudents.php");
} else {
    echo "Error: " . $sql . "<br>" . $connect->error;
}

$connect->close();
?>