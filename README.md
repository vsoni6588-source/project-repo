Expense Tracker System

A simple and user-friendly Expense Tracker built with PHP and MySQL. The application allows users to register, log in, and manage their daily expenses through a clean dashboard interface.

Features

* User Registration and Login
* Session-Based Authentication
* Add New Expenses
* Edit Existing Expenses
* Delete Expenses
* Expense Categories
* Total Expense Summary
* Transaction Count
* Recent Expense Display
* Responsive User Interface

Technologies Used

Frontend

* HTML5
* CSS3

Backend

* PHP

Database

* MySQL

Project Structure

expense-tracker/
│
├── index.php
├── login.php
├── signup.php
├── logout.php
├── add.php
├── edit.php
├── style.css
├── admin.png
└── README.md

Database Setup

Create a database named:

expense_tracker

Users Table

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

Expenses Table

CREATE TABLE expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(255) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    category VARCHAR(100) NOT NULL,
    date DATE NOT NULL,
    user_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

Installation

Clone Repository

git clone https://github.com/vsoni6588-source/project-repo.git

Move Project

Place the project folder inside:

C:\xampp\htdocs\

Start Server

Open XAMPP and start:

* Apache
* MySQL

Run Application

http://localhost/project-repo/login.php

Application Workflow

1. Create a new account.
2. Login using your credentials.
3. Add expenses with category and date.
4. View all expenses on the dashboard.
5. Edit or delete expenses anytime.
6. Monitor total spending and recent transactions.

Future Improvements

* Password Hashing
* SQL Injection Protection
* Expense Charts and Analytics
* Monthly Reports
* Budget Tracking
* Export to PDF/Excel
* Dark Mode
* Search and Filter Expenses

Author

Vinay Soni

License

This project is intended for educational and portfolio purposes.
