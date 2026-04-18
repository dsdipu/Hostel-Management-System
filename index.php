<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="./styles/output.css">
    <title>HMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen overflow-hidden">

    <header class="pl-10 pt-10 absolute top-0 hidden md:block">
        <img src="./images/logo.png" alt="" class="w-24 h-auto">
    </header>

    <main class="h-full flex items-center justify-center px-4">
        <div class="w-full max-w-6xl">
            
            <h1 class="text-blue-600 text-2xl sm:text-3xl md:text-4xl font-bold text-center mb-6 md:mb-10">
                Hostel Management System
            </h1>

            <div class="flex flex-col md:flex-row items-center justify-center gap-6 md:gap-10">

                <!-- Admin Login -->
                <div class="w-full max-w-md bg-white border-2 border-green-600 rounded-md py-6 sm:py-8 md:py-10 px-5 sm:px-8">
                    <p class="text-base sm:text-lg text-green-600 font-semibold text-center">
                        Admin Login
                    </p>
                    
                    <form method="POST" action="Admin/adminLogin.php">
                        <div class="mt-6">
                            <input type="text" name="username" placeholder="Enter Your Username" required
                                class="bg-green-200 py-2 pl-5 w-full rounded-md mb-3 text-sm sm:text-base">

                            <input type="password" name="password" placeholder="Enter Your Password" required
                                class="bg-green-200 py-2 pl-5 w-full rounded-md mb-3 text-sm sm:text-base">

                            <button type="submit" name="admin_login"
                                class="bg-blue-600 border-2 border-transparent text-white font-bold cursor-pointer py-2 w-full rounded-md text-sm sm:text-base hover:bg-transparent hover:border-blue-600 hover:text-blue-600 duration-300">
                                Login
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Student Login -->
                <div class="w-full max-w-md bg-green-600 border-2 border-green-600 rounded-md py-6 sm:py-8 md:py-10 px-5 sm:px-8 text-white">
                    <p class="text-base sm:text-lg font-semibold text-center">
                        Student Login
                    </p>
                    
                    <form method="POST" action="Student/studentLogin.php">
                        <div class="mt-6">
                            <input type="text" name="student_id" placeholder="Enter Your Student ID" required
                                class="bg-gray-200 text-gray-800 py-2 pl-5 w-full rounded-md mb-3 text-sm sm:text-base">

                            <input type="password" name="password" placeholder="Enter Your Password" required
                                class="bg-gray-200 text-gray-800 py-2 pl-5 w-full rounded-md mb-3 text-sm sm:text-base">

                            <button type="submit" name="student_login"
                                class="bg-blue-600 border-2 border-transparent text-white font-bold cursor-pointer py-2 w-full rounded-md text-sm sm:text-base hover:bg-transparent hover:border-white duration-300">
                                Login
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </main>
    
</body>
</html>