-- Create the database
CREATE DATABASE IF NOT EXISTS law_library;
USE law_library;

-- Create the 'laws' table
CREATE TABLE IF NOT EXISTS laws (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    law_number VARCHAR(50) NOT NULL,
    category VARCHAR(100) NOT NULL,
    year INT NOT NULL,
    description TEXT
);

-- Create the 'constitutions' table
CREATE TABLE IF NOT EXISTS constitutions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    year INT NOT NULL,
    description TEXT
);

-- Insert some sample data (optional but helpful for the student)
INSERT INTO laws (title, law_number, category, year, description) VALUES
('Civil Rights Act', 'L-001', 'Civil Law', 1964, 'An act to enforce the constitutional right to vote.'),
('Tax Reform Act', 'L-002', 'Tax Law', 1986, 'Comprehensive reform of the tax code.');

INSERT INTO constitutions (title, year, description) VALUES
('National Constitution', 1990, 'The supreme law of the country.'),
('Amendment 1', 1995, 'First amendment regarding freedom of speech.');
