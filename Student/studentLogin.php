<?php
session_start();
include "../php/dbConnect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_POST['student_id'];
    $password = $_POST['password'];
    
    $result = $connect->query("SELECT * FROM students WHERE student_id = '$student_id'");
    $student = $result->fetch_assoc();
    
    if ($student && $password == $student_id) {
        $_SESSION['student_logged_in'] = true;
        $_SESSION['student_id'] = $student_id;
        header("Location: studentDashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid Student ID or Password'); window.location='../index.php';</script>";
    }
}
?>