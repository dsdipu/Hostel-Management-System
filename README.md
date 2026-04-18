# 🏠 Hostel Management System
A complete web-based Hostel Management System built with PHP and MySQL. This system allows admins to manage students, rooms, payments, and complaints, while students can view their room details and payment status.

🔗 Live Demo: [View](https://hotelms.page.gd)
🔗 Repo Link: [View](https://github.com/dsdipu/Hostel-Management-System)

---

## 📌 Overview

Hostel Management System is a full-stack web application designed to digitalize hostel operations. It provides separate interfaces for admin and students. Admins can manage student registrations, room allocation, payment tracking, and view dashboard analytics. Students can log in to view their assigned room, check payment status, and submit complaints.

This project demonstrates database integration, session management, CRUD operations, and secure login functionality.

---

## 🛠️ Tech Stack

- PHP
- MySQL
- HTML5
- CSS3 / TailwindCSS
- JavaScript (basic)

---

## ✨ Features

### Admin Panel
- Secure Admin Login
- Dashboard with Analytics (Total Students, Rooms, Pending Payments, Available Seats)
- Student Management (Add, View, Delete Students)
- Room Management (Add, View Rooms with Occupancy Status)
- Payment Management (Record, View Payment History)
- Auto Student ID Generation (Format: s260001)
- Soft Delete (Deleted_at timestamp)

### Student Panel
- Secure Student Login (Default Password: Student ID)
- View Personal Information
- View Payment Status with Date & Time
- Responsive Dashboard

### Additional Features
- Automatic Room Occupancy Update
- Payment Timestamp Tracking
- Session-based Authentication
- Database Relationships (Foreign Keys)

---

## 📂 Project Structure

```
hostel-management-system/
│
├── Admin/
│ ├── adminDashboard.php
│ ├── adminStudents.php
│ ├── adminRooms.php
│ ├── adminPayments.php
│ └── adminLogin.php
│
├── Student/
│ ├── studentDashboard.php
│ └── studentLogin.php
│
├── php/
│ ├── dbConnect.php
│ ├── addStudent.php
│ └── deleteStudent.php
│
├── images/
├── styles/
├── index.php
└── README.md
```


---

## ⚙️ Installation & Setup

### Local Setup (XAMPP)

1. **Clone the repository**
```bash
git clone https://github.com/dsdipu/Hostel-Management-System.git
cd Hostel-Management-System
```

2. **Move to htdocs folder**

```bash
Copy the folder to C:\xampp\htdocs\
```

3. Start Xampp
    - Start Apache and MySQL services

4. Create Database
    - Open phpMyAdmin at http://localhost/phpmyadmin
    - Create database named hostelMS
    - Import the SQL file (provided in the repository)

5. Update Database Connection
    - Edit php/dbConnect.php with your database credentials

6. Run the Project

```bash
http://localhost/hostel-management-system/index.php
```

### Default Login Credential

<table border="1" cellpadding="10" cellspacing="0">
  <thead>
    <tr>
      <th>Role</th>
      <th>Username/ID</th>
      <th>Password</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Admin</td>
      <td>admin</td>
      <td>admin123</td>
    </tr>
  </tbody>
</table>

### 🎯 Purpose of the Project

This project was built to:

    1 Implement PHP & MySQL integration
    2 Practice CRUD operations
    3 Understand session management and authentication
    4 Build a real-world database-driven application
    5 Learn frontend-backend connectivity
    6 Create a portfolio-worthy full-stack project

📬 Contact
<p align="left"> <a href="https://www.linkedin.com/in/dsdipu" target="_blank"><img src="https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white"/></a> <a href="https://www.facebook.com/dsdipu0" target="_blank"><img src="https://img.shields.io/badge/Facebook-1877F2?style=for-the-badge&logo=facebook&logoColor=white"/></a> <a href="https://www.instagram.com/dsdipu0" target="_blank"><img src="https://img.shields.io/badge/Instagram-E4405F?style=for-the-badge&logo=instagram&logoColor=white"/></a> <a href="mailto:mr.sarkar9979@gmail.com" target="_blank"><img src="https://img.shields.io/badge/Gmail-D14836?style=for-the-badge&logo=gmail&logoColor=white"/></a> <a href="https://github.com/dsdipu" target="_blank"><img src="https://img.shields.io/badge/GitHub-000000?style=for-the-badge&logo=github&logoColor=white"/></a> </p>

© 2026 Dipankar Sarkar