# MEDIPLUS

MEDIPLUS is an integrated online healthcare management system that enables patients to book appointments, consult with doctors, and access essential medical services securely. This project is designed to provide efficient, user-friendly interaction between patients and healthcare professionals.

## 📌 Project Highlights

- Secure user authentication (login & registration)
- Appointment booking system with confirmation
- Contact form for communication with medical staff
- Doctor listings with specialization filters
- Admin access to manage appointments and users
- Responsive interface and dashboard
- Data storage using MySQL database

## 🛠 Tech Stack

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL
- **Server:** XAMPP (Apache + MySQL)
- **IDE/Editor:** VS Code / Sublime Text
- **Deployment:** Localhost (can be extended to live server)

## 🚀 Features

### 👤 User Side
- Register and Login
- Book appointments with doctors
- Browse available doctors
- Submit queries or contact forms
- View booking status

### ⚙️ Admin Side
- View/manage all appointments
- View contact messages
- Add/edit doctor profiles (optional feature)
- Monitor system activities

## 🔐 Login System
- Users must log in to:
  - Access **Book Appointment**
  - Submit **Contact Us** forms
  - Access **Doctors** section
- Once logged in:
  - The **Get Started** button disappears
  - Actions are logged into specific MySQL tables

## 📂 Folder Structure

D:\xmp\htdocs\college_project
│
├── mediplus/
│ ├── index.html
│ ├── login.php
│ ├── register.php
│ ├── book_appointment.php
│ ├── contact.php
│ ├── doctors.php
│ ├── logout.php
│ ├── assets/ (CSS, JS, images)
│ └── includes/ (header.php, footer.php, db.php)
│
├── database/
│ ├── mediplus.sql

markdown
Copy
Edit

## 🧮 Database Tables

- `users` — stores user registration/login data
- `appointments` — stores booking details
- `contacts` — stores contact form submissions
- `doctors` — stores doctor info (optional)

## ⚙️ How to Run (Localhost)

1. Install [XAMPP](https://www.apachefriends.org/)
2. Place the `mediplus` folder inside `htdocs` (`D:\xmp\htdocs\college_project`)
3. Start Apache and MySQL from XAMPP Control Panel
4. Import the `mediplus.sql` file into phpMyAdmin
5. Open your browser and go to:
http://localhost/college_project/mediplus

yaml
Copy
Edit

## 📸 Screenshots

*(Add screenshots of the homepage, login, appointment booking, and admin dashboard for better presentation.)*

## 📄 Project Report

A comprehensive report includes:
- Introduction
- Objective
- Existing vs Proposed System
- System Design (DFD, UML)
- Database Schema
- Implementation
- Testing & Conclusion

## 🧑‍💻 Contributors

- **Name:** Divyansh Sharma
- **Department:** Computer Engineering
- **Institution:** [Your College Name Here]

---

## 📬 Contact

For queries or feedback, please email: [your.email@example.com]

---
