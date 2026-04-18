<?php
session_start();
include "../php/dbConnect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = mysqli_real_escape_string($connect, $_POST['student_id']);
    $password = $_POST['password'];
    
    $result = $connect->query("SELECT * FROM students WHERE student_id = '$student_id' AND deleted_at IS NULL");
    
    if ($result && $result->num_rows > 0) {
        $student = $result->fetch_assoc();
        
        // Check password (default: student_id)
        if ($password == $student_id) {
            $_SESSION['student_logged_in'] = true;
            $_SESSION['student_id'] = $student_id;
            header("Location: studentDashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid Password'); window.location='../index.php';</script>";
        }
    } else {
        echo "<script>alert('Student ID not found'); window.location='../index.php';</script>";
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>