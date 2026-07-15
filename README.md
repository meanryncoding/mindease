# 🧠 MindEase
### UiTM Student Mental Wellness Portal

![CakePHP](https://img.shields.io/badge/CakePHP-4.x-red?style=flat-square&logo=cakephp)
![PHP](https://img.shields.io/badge/PHP-8.0+-blue?style=flat-square&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange?style=flat-square&logo=mysql)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-purple?style=flat-square&logo=bootstrap)

**MindEase** is a web-based mental wellness portal developed for UiTM students to perform self-assessment screening (PHQ-9, GAD-7, PSS-4) and connect with qualified counselors. Built as part of the **IMS566 Advanced Web Design Development and Content Management** group assignment.

---

## 📚 Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Test Accounts](#test-accounts)
- [Usage Guide](#usage-guide)
- [Project Structure](#project-structure)
- [Troubleshooting](#troubleshooting)

---

## ✨ Features

- **User Authentication** — Secure login/logout with role-based access (Admin, Counselor, Student)
- **Mental Health Assessment** — Multi-step assessment covering PHQ-9 (Depression), GAD-7 (Anxiety), PSS-4 (Stress) and General Wellbeing
- **Crisis Detection** — Automatic crisis alert system with emergency contact information
- **Counselor Notes** — Counselors can add clinical notes, action taken and follow-up dates
- **Dashboard** — Role-specific dashboards with charts and statistics
- **Search & Filter** — Filter assessments by risk level, flagged status, review status and date range
- **Export to PDF** — Generate PDF reports for assessments, counselor notes and questions
- **Profile Management** — Update student information including Faculty, Program and Year of Study
- **FAQ & Contact Us** — Built-in FAQ system and contact form with ticket tracking
- **Dark Mode** — Support for light and dark theme

---

## 📋 Requirements

- **PHP** 8.3 or higher
- **MySQL** 5.7+ or MariaDB 10.3+
- **Composer** (PHP dependency manager)
- **Web Server** — Laragon (recommended for Windows)

---

## ⚙️ Installation

### Step 1: Clone the Repository

```bash
git clone https://github.com/meanryncoding/mindease.git
cd mindease
```

### Step 2: Install Dependencies

```bash
composer install
```

### Step 3: Configure Environment

1. Copy the example configuration file:

```bash
cp config/app_local.example.php config/app_local.php
```

2. Edit `config/app_local.php` and update the database credentials:

```php
'Datasources' => [
    'default' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'database' => 'mindease',
    ],
],
```

### Step 4: Set Directory Permissions

```bash
# Linux/Mac
chmod -R 777 logs tmp

# Windows (Laragon)
# Permissions are set automatically
```

---

## 🗄️ Database Setup

### Step 1: Create the Database

Using phpMyAdmin or MySQL command line:

```sql
CREATE DATABASE mindease CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Step 2: Import Database

Import the provided SQL file:

```bash
mysql -u root -p mindease < database/mindease.sql
```

Or using phpMyAdmin:

1. Open phpMyAdmin (`http://localhost/phpmyadmin`)
2. Select the `mindease` database
3. Click **Import**
4. Choose `database/mindease.sql` and click **Go**

---

## 🔑 Test Accounts

### Administrator Account

| Field    | Value                   |
|----------|-------------------------|
| Email    | `admin@mindease.com`    |
| Password | `admin123`              |

### Counselor Account

| Field    | Value                      |
|----------|----------------------------|
| Email    | `counselor@mindease.com`   |
| Password | `password`                 |

### Student Account

| Field    | Value                    |
|----------|--------------------------|
| Email    | `student@mindease.com`   |
| Password | `password`               |
| Email    | `student2@mindease.com`  |
| Password | `password`               |

> 💡 **Tip:** Login as **Admin** first to manage users and questions. Use **Student** account to experience the assessment workflow. Use **Counselor** account to review assessments and add clinical notes.

---

## 📖 Usage Guide

### Getting Started

1. Start **Laragon**
2. Access the application at: `http://mindease.test` or `http://localhost/mindease`

### For Students

1. **Login** with student credentials
2. Go to **New Assessment** to complete a mental health screening
3. View your results and history in **My History**
4. Update your profile information in **Profile → Update**

### For Counselors

1. **Login** with counselor credentials
2. View all student assessments in **All Assessments**
3. Filter by risk level, flagged status or review status
4. Click the 📝 button to add a **Counselor Note** for any assessment
5. View and manage all notes in **Counselor Notes**

### For Administrators

1. **Login** with admin credentials
2. Manage users in **User Management**
3. Manage assessment questions in **Questions**
4. Export wellness reports as PDF
5. View audit trail in **Audit Trail**

---

## 📁 Project Structure

```
mindease/
├── config/              # Configuration files
├── database/            # SQL database file
├── src/
│   ├── Controller/      # Application controllers
│   ├── Model/           # Database models (Tables & Entities)
│   └── View/            # View helpers
├── templates/           # Template files (Views)
│   ├── Assessments/     # Assessment views
│   ├── CounselorNotes/  # Counselor notes views
│   ├── Dashboards/      # Dashboard views
│   ├── Questions/       # Questions management views
│   ├── Users/           # User management views
│   ├── layout/          # Layout templates
│   └── element/         # Reusable UI elements (sidebar, topbar)
├── webroot/             # Publicly accessible files
├── logs/                # Application logs
├── tmp/                 # Temporary files and cache
└── vendor/              # Composer dependencies
```

---

## 🖥️ Running the Application

### Using Laragon (Recommended for Windows)

1. Place the project in `C:\laragon\www\mindease`
2. Start Laragon
3. Access via `http://mindease.test` or `http://localhost/mindease`

### Using CakePHP Built-in Server

```bash
bin/cake server -p 8765
```

Visit `http://localhost:8765`

---

## 🔧 Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Verify `config/app_local.php` has correct database credentials
   - Ensure MySQL/MariaDB service is running in Laragon
   - Check if the `mindease` database exists

2. **Permission Denied Errors**
   - Ensure `logs/` and `tmp/` directories are writable
   - On Linux: `chmod -R 777 logs tmp`

3. **White Screen / 500 Error**
   - Check `logs/error.log` for detailed error messages
   - Enable debug mode in `config/app_local.php`: `'debug' => true`

4. **CSS/JS Not Loading**
   - Check `.htaccess` file in root and `webroot/` directories
   - Ensure mod_rewrite is enabled in Apache

---

## 👥 Group Members

- PUTERI NURYASMIN FARHANA BINTI MEGAT MOHD ZULKARNAIN - 2024402302
- AHMAD RAIYAN IMAN BIN AZWAN - 2024413898
- NUR AZWA BINTI ABDUL AZIZ - 2024665854
- ASMA AINA BINTI JURAIME - 2024804792

---

## 🏫 Course Information

- **Course:** IMS566 - Advanced Web Design Development and Content Management
- **Institution:** Universiti Teknologi MARA (UiTM), Puncak Perdana
- **Type:** Group Assignment

---

## 🙏 Acknowledgments

- [CakePHP Framework](https://cakephp.org/)
- [ReCRUD by Code The Pixel](https://codethepixel.com/)
- [Bootstrap 5](https://getbootstrap.com/)
- [Laragon](https://laragon.org/)
- [Font Awesome](https://fontawesome.com/)
- [Vanta.js](https://www.vantajs.com/)
- [Pusat Psikologi & Kaunseling UiTM](https://counselling.uitm.edu.my/)