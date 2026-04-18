<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">

    <?php
    include "../php/dbConnect.php";

    // Add payment logic with created_at
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_payment'])) {
        $studentId = $_POST['student_id'];
        $month = $_POST['month'];
        $amount = $_POST['amount'];
        $status = $_POST['status'];
        
        $insert = $connect->query("INSERT INTO payments (student_id, month, amount, status, created_at) 
                                   VALUES ('$studentId', '$month', '$amount', '$status', NOW())");
        if ($insert) {
            header("Location: adminPayments.php");
            exit();
        }
    }

    // Fetch all payments with time
    $payments = $connect->query("SELECT * FROM payments ORDER BY created_at DESC");
    ?>

    <div class="w-64 bg-green-600 text-white min-h-screen p-5">
        <h2 class="text-2xl font-bold mb-6">Admin Panel</h2>
        <ul class="space-y-3">
            <li><a href="adminDashboard.php" class="block hover:bg-blue-700 p-2 rounded">Dashboard</a></li>
            <li><a href="adminStudents.php" class="block hover:bg-blue-700 p-2 rounded">Students</a></li>
            <li><a href="adminRooms.php" class="block hover:bg-blue-700 p-2 rounded">Rooms</a></li>
            <li><a href="adminPayments.php" class="block bg-blue-700 p-2 rounded">Payments</a></li>
        </ul>
        <a href="../index.php" class="block bg-red-500 hover:bg-red-600 text-white p-2 rounded text-center mt-6">
            Logout
        </a>
    </div>

    <div class="flex-1 p-6">

        <h1 class="text-3xl font-bold mb-6">Payment Management</h1>

        <div class="bg-white p-5 rounded shadow mb-6">
            <h2 class="text-xl font-semibold mb-4">Record Payment</h2>

            <form method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input type="text" name="student_id" placeholder="Student ID" class="border p-2 rounded" required>
                <input type="text" name="month" placeholder="Month (e.g. June)" class="border p-2 rounded" required>
                <input type="number" name="amount" placeholder="Amount" class="border p-2 rounded" required>
                <select name="status" class="border p-2 rounded">
                    <option>Paid</option>
                    <option>Pending</option>
                </select>
                <button type="submit" name="add_payment" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600 md:col-span-4">
                    Add Payment
                </button>
            </form>
        </div>

        <div class="bg-white p-5 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Payment History</h2>

            <table class="w-full border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border">Student ID</th>
                        <th class="p-2 border">Month</th>
                        <th class="p-2 border">Amount</th>
                        <th class="p-2 border">Status</th>
                        <th class="p-2 border">Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $payments->fetch_assoc()): ?>
                    <tr>
                        <td class="p-2 border"><?php echo $row['student_id']; ?></td>
                        <td class="p-2 border"><?php echo $row['month']; ?></td>
                        <td class="p-2 border"><?php echo $row['amount']; ?></td>
                        <td class="p-2 border <?php echo ($row['status'] == 'Paid') ? 'text-green-500' : 'text-red-500'; ?>">
                            <?php echo $row['status']; ?>
                        </td>
                        <td class="p-2 border"><?php echo date('d/m/Y h:i A', strtotime($row['created_at'])); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>