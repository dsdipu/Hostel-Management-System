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

        <div class="bg-white p-5 rounded shadow mb-6">
            <h2 class="text-xl font-semibold mb-4">Add New Student</h2>
            <form action="../php/addStudent.php" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input type="text" name="studentID" placeholder="Student ID" class="border p-2 rounded">
                <input type="text" name="studentName" placeholder="Student Name" class="border p-2 rounded">
                <input type="text" name="department" placeholder="Department" class="border p-2 rounded">
                <input type="text" name="phone" placeholder="Phone Number" class="border p-2 rounded">
                <input type="text" name="roomID" placeholder="Room Number" class="border p-2 rounded">
                <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 md:col-span-2">
                    Add Student
                </button>
            </form>
        </div>

        <div class="bg-white p-5 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Students List</h2>
            <table class="w-full border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border">Name</th>
                        <th class="p-2 border">Department</th>
                        <th class="p-2 border">Room</th>
                        <th class="p-2 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "../php/dbConnect.php";
                    $result = $connect->query("SELECT * FROM students");
                    while($row = $result->fetch_assoc()):
                    ?>
                    <tr>
                        <td class="p-2 border"><?php echo $row['name']; ?></td>
                        <td class="p-2 border"><?php echo $row['department']; ?></td>
                        <td class="p-2 border"><?php echo $row['room_id']; ?></td>
                        <td class="p-2 border space-x-2">
                            <button class="bg-yellow-400 px-3 py-1 rounded">Edit</button>
                            <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>