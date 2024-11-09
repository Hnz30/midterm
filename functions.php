<?php
session_start();

// User Authentication Functions
function getUsers() {
    return [
        ['email' => 'user1@email.com', 'password' => 'password'],
        // Add more users if needed
    ];
}

function validateLoginCredentials($email, $password) {
    $errors = [];
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    }
    return $errors;
}

function checkLoginCredentials($email, $password, $users) {
    foreach ($users as $user) {
        if ($user['email'] == $email && $user['password'] == $password) {
            return true;
        }
    }
    return false;
}

function checkUserSessionIsActive() {
    if (!isset($_SESSION['email'])) {
        header("Location: index.php");
        exit;
    }
}

function guard() {
    if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
        header("Location: index.php");
        exit;
    }
}

// Error Handling Functions
function displayErrors($errors) {
    $output = "<strong>System Errors:</strong><ul>";
    foreach ($errors as $error) {
        $output .= "<li>$error</li>";
    }
    $output .= "</ul>";
    return $output;
}

function renderErrorsToView($error) {
    return empty($error) ? null : "<div class='alert alert-danger alert-dismissible fade show' role='alert'>$error<button type='button' class='btn-close' data-bs-dismiss='alert'></button></div>";
}

function getBaseURL() {
    return "http://localhost/your_project_directory/";
}

// Student Management Functions
function validateStudentData($student_data) {
    $errors = [];
    if (empty($student_data['student_id'])) $errors[] = "Student ID is required.";
    if (empty($student_data['first_name'])) $errors[] = "First name is required.";
    if (empty($student_data['last_name'])) $errors[] = "Last name is required.";
    return $errors;
}

// ... More student and subject functions go here

?>
