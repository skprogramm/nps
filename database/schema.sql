-- NPS Education Database Schema
-- Run this SQL to create the database and tables

CREATE DATABASE IF NOT EXISTS nps_education;
USE nps_education;

-- Courses Table
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    duration VARCHAR(100),
    eligibility VARCHAR(255),
    certification VARCHAR(255),
    fee VARCHAR(100),
    image VARCHAR(255),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Admission Inquiries Table
CREATE TABLE IF NOT EXISTS admissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    guirdian_name VARCHAR(255),
    qualification VARCHAR(255),
    address TEXT,
    district VARCHAR(100),
    state VARCHAR(100),
    course VARCHAR(255),
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS franchises (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address TEXT,
    district VARCHAR(100),
    state VARCHAR(100),
    pin VARCHAR(7) NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Admin Login Table
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin user (password: admin123)
INSERT INTO admins (username, password, email) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'npseducation45@gmail.com')
ON DUPLICATE KEY UPDATE password = VALUES(password);

-- Contact Form Submissions Table
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address TEXT,
    message TEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample courses data
INSERT INTO courses (title, duration, eligibility, certification, fee, description) VALUES
('Digital Marketing', '3 months', '10th pass', 'Government Certified', '₹15,000', 'Complete digital marketing course covering SEO, social media, and online advertising'),
('Web Development', '6 months', '12th pass', 'Industry Recognized', '₹25,000', 'Full stack web development with HTML, CSS, JavaScript, and PHP'),
('Data Entry Operator', '2 months', '10th pass', 'Government Certified', '₹8,000', 'Professional data entry and computer skills training'),
('Hospitality Management', '4 months', '12th pass', 'Industry Certified', '₹20,000', 'Hotel management and hospitality service skills'),
('Electrical Technician', '5 months', '10th pass with Science', 'Government Certified', '₹18,000', 'Electrical installation and maintenance training'),
('Computer Applications', '3 months', '10th pass', 'Government Certified', '₹12,000', 'Basic computer skills and office applications')
ON DUPLICATE KEY UPDATE title = VALUES(title);
