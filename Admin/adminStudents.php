<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/favicon.png" type="image/x-icon">
    <title>HMS | Students Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">

<?php
session_start();
if(!isset($_SESSION['admin_logged_in'])) {
    header("Location: adminLogin.php");
    exit();
}
include "../php/dbConnect.php";
// Show only active students (not deleted)
$students = $connect->query("SELECT * FROM students WHERE deleted_at IS NULL ORDER BY created_at DESC");
?>

    <div class="w-64 bg-green-600 text-white min-h-screen p-5">
        <h2 class="text-2xl font-bold mb-6">Admin Panel</h2>
        <ul class="space-y-3">
            <li><a href="adminDashboard.php" class="block hover:bg-blue-700 p-2 rounded">Dashboard</a></li>
            <li><a href="adminStudents.php" class="block bg-blue-700 p-2 rounded">Students</a></li>
            <li><a href="adminRooms.php" class="block hover:bg-blue-700 p-2 rounded">Rooms</a></li>
            <li><a href="adminPayments.php" class="block hover:bg-blue-700 p-2 rounded">Payments</a></li>
        </ul>
        <a href="../index.php" class="block bg-red-500 hover:bg-red-600 text-white p-2 rounded text-center mt-6">
            Logout
        </a>
    </div>

    <div class="flex-1 p-6">
        <h1 class="text-3xl font-bold mb-6">Students Management</h1>

        <!-- Add Student Form -->
        <div class="bg-white p-5 rounded shadow mb-6">
            <h2 class="text-xl font-semibold mb-4">Add New Student</h2>
            <form action="../php/addStudent.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- <input type="text" name="studentID" placeholder="Student ID" class="border p-2 rounded" required> -->
                <input type="text" name="studentName" placeholder="Student Name" class="border p-2 rounded" required>
                <input type="text" name="department" placeholder="Department" class="border p-2 rounded" required>
                <input type="text" name="phone" placeholder="Phone Number" class="border p-2 rounded" required>
                <input type="text" name="roomID" placeholder="Room ID" class="border p-2 rounded" required>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 md:col-span-2">
                    Add Student
                </button>
            </form>
        </div>

        <!-- Students List -->
        <div class="bg-white p-5 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Students List</h2>
            <div class="overflow-x-auto">
                <table class="w-full border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border">Student ID</th>
                            <th class="p-2 border">Name</th>
                            <th class="p-2 border">Department</th>
                            <th class="p-2 border">Phone</th>
                            <th class="p-2 border">Room</th>
                            <th class="p-2 border">Added On</th>
                            <th class="p-2 border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($students->num_rows > 0): ?>
                            <?php while($row = $students->fetch_assoc()): ?>
                            <tr>
                                <td class="p-2 border"><?php echo htmlspecialchars($row['student_id']); ?></td>
                                <td class="p-2 border"><?php echo htmlspecialchars($row['name']); ?></td>
                                <td class="p-2 border"><?php echo htmlspecialchars($row['department']); ?></td>
                                <td class="p-2 border"><?php echo htmlspecialchars($row['phone']); ?></td>
                                <td class="p-2 border"><?php echo htmlspecialchars($row['room_id']); ?></td>
                                <td class="p-2 border"><?php echo date('d/m/Y', strtotime($row['created_at'])); ?></td>
                                <td class="p-2 border space-x-2">
                                    <button class="bg-yellow-400 px-3 py-1 rounded hover:bg-yellow-500">Edit</button>
                                    <form method="POST" action="../php/deleteStudent.php" style="display:inline;" onsubmit="return confirm('Delete this student?')">
                                        <input type="hidden" name="student_id" value="<?php echo $row['student_id']; ?>">
                                        <input type="hidden" name="room_id" value="<?php echo $row['room_id']; ?>">
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                                    </form>
                                 </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="p-2 border text-center text-gray-500">No students found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>