-- Create the database
CREATE DATABASE bus_routing_system;

-- Use the database
USE bus_routing_system;

-- Create the users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    position ENUM('staff', 'student') NOT NULL
);

-- Create the students table
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    faculty VARCHAR(100) NOT NULL,
    registration_no VARCHAR(50) NOT NULL,
    location VARCHAR(100) NOT NULL,
    contact_no VARCHAR(15) NOT NULL,
    username VARCHAR(50) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    UNIQUE (username)
);

-- Create the staff table
CREATE TABLE staff (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    faculty_department VARCHAR(100) NOT NULL,
    location VARCHAR(100) NOT NULL,
    contact_no VARCHAR(15) NOT NULL,
    username VARCHAR(50) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    UNIQUE (username)
);
