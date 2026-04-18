<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])) {
    header("Location: adminLogin.php");
    exit();
}
include "../php/dbConnect.php";

// Count total students
$studentResult = $connect->query("SELECT COUNT(*) as total FROM students");
$totalStudents = $studentResult->fetch_assoc()['total'];

// Count total rooms
$roomResult = $connect->query("SELECT COUNT(*) as total FROM rooms");
$totalRooms = $roomResult->fetch_assoc()['total'];

// Count pending payments
$paymentResult = $connect->query("SELECT COUNT(*) as total FROM payments WHERE status = 'Pending'");
$pendingPayments = $paymentResult->fetch_assoc()['total'];

// Calculate available seats
$capacityResult = $connect->query("SELECT SUM(capacity) as total_capacity FROM rooms");
$occupancyResult = $connect->query("SELECT SUM(occupancy) as total_occupancy FROM rooms");
$totalCapacity = $capacityResult->fetch_assoc()['total_capacity'];
$totalOccupancy = $occupancyResult->fetch_assoc()['total_occupancy'];
$availableSeats = $totalCapacity - $totalOccupancy;

// Get recent students
$recentStudents = $connect->query("SELECT name, room_id, created_at FROM students ORDER BY created_at DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
    <title>HMS | Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
    <body class="bg-gray-100 flex">

        <div class="w-64 bg-green-600 text-white min-h-screen p-5">
            <h2 class="text-2xl font-bold mb-6">Admin Panel</h2>
            <ul class="space-y-3">
                <li><a href="adminDashboard.php" class="block bg-blue-700 p-2 rounded">Dashboard</a></li>
                <li><a href="adminStudents.php" class="block hover:bg-blue-700 p-2 rounded">Students</a></li>
                <li><a href="adminRooms.php" class="block hover:bg-blue-700 p-2 rounded">Rooms</a></li>
                <li><a href="adminPayments.php" class="block hover:bg-blue-700 p-2 rounded">Payments</a></li>
            </ul>
            <a href="../index.php" class="block bg-red-500 hover:bg-red-600 text-white p-2 rounded text-center mt-6">
                Logout
            </a>
        </div>

        <div class="flex-1 p-6">
            <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white p-5 rounded shadow">
                    <h3 class="text-gray-500">Total Students <span>(All time)</span></h3>
                    <p class="text-2xl font-bold"><?php echo $totalStudents; ?></p>
                </div>

                <div class="bg-white p-5 rounded shadow">
                    <h3 class="text-gray-500">Total Rooms</h3>
                    <p class="text-2xl font-bold"><?php echo $totalRooms; ?></p>
                </div>

                <div class="bg-white p-5 rounded shadow">
                    <h3 class="text-gray-500">Pending Payments</h3>
                    <p class="text-2xl font-bold text-red-500"><?php echo $pendingPayments; ?></p>
                </div>

                <div class="bg-white p-5 rounded shadow">
                    <h3 class="text-gray-500">Available Seats</h3>
                    <p class="text-2xl font-bold text-green-500"><?php echo $availableSeats; ?></p>
                </div>
            </div>

            <div class="bg-white p-5 rounded shadow">
                <h2 class="text-xl font-semibold mb-4">New Students</h2>
                <table class="w-full border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border">Name</th>
                            <th class="p-2 border">Room</th>
                            <th class="p-2 border">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $recentStudents->fetch_assoc()): ?>
                        <tr>
                            <td class="p-2 border"><?php echo $row['name']; ?></td>
                            <td class="p-2 border"><?php echo $row['room_id']; ?></td>
                            <td class="p-2 border text-green-500">Paid</td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>