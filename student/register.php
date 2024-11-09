<?php
require '../functions.php';
guard();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_data = [
        'student_id' => $_POST['student_id'],
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name']
    ];
    $errors = validateStudentData($student_data);

    if (empty($errors)) {
        $_SESSION['student_data'][] = $student_data;
        header("Location: ../dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Student</title>
</head>
<body>
    <form action="register.php" method="POST">
        <input type="text" name="student_id" placeholder="Student ID" required>
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <button type="submit">Register</button>
    </form>
    <?php if (!empty($errors)) echo displayErrors($errors); ?>
</body>
</html>
