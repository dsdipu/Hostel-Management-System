<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<?php
session_start();
if(!isset($_SESSION['student_logged_in'])) {
    header("Location: studentLogin.php");
    exit();
}
$studentID = $_SESSION['student_id'];
include "../php/dbConnect.php";

// Fetch student info
$studentQuery = $connect->query("SELECT * FROM students WHERE student_id = '$studentID'");
$student = $studentQuery->fetch_assoc();

// Fetch payment history with time
$payments = $connect->query("SELECT * FROM payments WHERE student_id = '$studentID' ORDER BY created_at DESC");
?>

    <!-- Header -->
    <div class="bg-green-600 text-white p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">Student Dashboard</h1>
        <a href="../index.php" class="bg-red-500 px-4 py-2 rounded hover:bg-red-600">Logout</a>
    </div>

    <!-- Main Content -->
    <div class="p-6">

        <!-- Student Info -->
        <div class="bg-white p-5 rounded shadow mb-6">
            <h2 class="text-xl font-semibold mb-4">My Information</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($student['name']); ?></p>
                <p><strong>Student ID:</strong> <?php echo htmlspecialchars($student['student_id']); ?></p>
                <p><strong>Department:</strong> <?php echo htmlspecialchars($student['department']); ?></p>
                <p><strong>Room Number:</strong> <?php echo htmlspecialchars($student['room_id']); ?></p>
            </div>
        </div>

        <!-- Payment Table -->
        <div class="bg-white p-5 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Payment Status</h2>

            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border">Month</th>
                            <th class="p-2 border">Amount</th>
                            <th class="p-2 border">Status</th>
                            <th class="p-2 border">Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($payments && $payments->num_rows > 0): ?>
                            <?php while($row = $payments->fetch_assoc()): ?>
                            <tr>
                                <td class="p-2 border"><?php echo htmlspecialchars($row['month']); ?></td>
                                <td class="p-2 border"><?php echo htmlspecialchars($row['amount']); ?> <span class="text-xl font-black">৳</span></td>
                                <td class="p-2 border <?php echo ($row['status'] == 'Paid') ? 'text-green-500' : 'text-red-500'; ?>">
                                    <?php echo htmlspecialchars($row['status']); ?>
                                 </td>
                                <td class="p-2 border"><?php echo date('d/m/Y h:i A', strtotime($row['created_at'])); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="p-2 border text-center text-gray-500">No payment records found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>