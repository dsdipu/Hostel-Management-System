<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])) {
    header("Location: adminLogin.php");
    exit();
}
include "../php/dbConnect.php";

// Add room logic
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_room'])) {
    $roomNumber = $_POST['room_number'];
    $roomType = $_POST['room_type'];
    $capacity = $_POST['capacity'];
    
    $insert = $connect->query("INSERT INTO rooms (room_number, room_type, capacity, occupancy, created_at) 
                               VALUES ('$roomNumber', '$roomType', '$capacity', 0, NOW())");
    if ($insert) {
        header("Location: adminRooms.php");
        exit();
    }
}

// Fetch all rooms
$rooms = $connect->query("SELECT * FROM rooms");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">

    <div class="w-64 bg-green-600 text-white min-h-screen p-5">
        <h2 class="text-2xl font-bold mb-6">Admin Panel</h2>
        <ul class="space-y-3">
            <li><a href="adminDashboard.php" class="block hover:bg-blue-700 p-2 rounded">Dashboard</a></li>
            <li><a href="adminStudents.php" class="block hover:bg-blue-700 p-2 rounded">Students</a></li>
            <li><a href="adminRooms.php" class="block bg-blue-700 p-2 rounded">Rooms</a></li>
            <li><a href="adminPayments.php" class="block hover:bg-blue-700 p-2 rounded">Payments</a></li>
        </ul>
        <a href="../index.php" class="block bg-red-500 hover:bg-red-600 text-white p-2 rounded text-center mt-6">
            Logout
        </a>
    </div>

    <div class="flex-1 p-6">

        <h1 class="text-3xl font-bold mb-6">Room Management</h1>

        <div class="bg-white p-5 rounded shadow mb-6">
            <h2 class="text-xl font-semibold mb-4">Add New Room</h2>

            <form method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <input type="text" name="room_number" placeholder="Room Number" class="border p-2 rounded" required>
                
                <select name="room_type" class="border p-2 rounded">
                    <option>Single</option>
                    <option>Double</option>
                </select>

                <input type="number" name="capacity" placeholder="Capacity" class="border p-2 rounded" required>

                <button type="submit" name="add_room" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 md:col-span-3">
                    Add Room
                </button>
            </form>
        </div>

        <div class="bg-white p-5 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Room List</h2>

            <table class="w-full border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border">Room No</th>
                        <th class="p-2 border">Type</th>
                        <th class="p-2 border">Capacity</th>
                        <th class="p-2 border">Occupancy</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $rooms->fetch_assoc()): ?>
                    <tr>
                        <td class="p-2 border"><?php echo $row['room_number']; ?></td>
                        <td class="p-2 border"><?php echo $row['room_type']; ?></td>
                        <td class="p-2 border"><?php echo $row['capacity']; ?></td>
                        <td class="p-2 border"><?php echo $row['occupancy']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>