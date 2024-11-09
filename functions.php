<?php
session_start();

// User Authentication Functions
function getUsers() {
    return [
        ['email' => 'user1@example.com', 'password' => 'password'],
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
        if ($user['email'] === $email && $user['password'] === $password) {
            return true;
        }
    }
    return false;
}

function guard() {
    if (!isset($_SESSION['email'])) {
        header("Location: index.php");
        exit;
    }
}

// Student Management Functions
function validateStudentData($student_data) {
    $errors = [];
    if (empty($student_data['student_id'])) $errors[] = "Student ID is required.";
    if (empty($student_data['first_name'])) $errors[] = "First name is required.";
    if (empty($student_data['last_name'])) $errors[] = "Last name is required.";
    return $errors;
}

function checkDuplicateStudentData($student_data) {
    if (isset($_SESSION['student_data'])) {
        foreach ($_SESSION['student_data'] as $student) {
            if ($student['student_id'] === $student_data['student_id']) {
                return ["Duplicate Student ID"];
            }
        }
    }
    return [];
}
?>
