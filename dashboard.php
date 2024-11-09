<?php
require 'functions.php';
guard();
?>

<?php include 'header.php'; ?>
<h1>Dashboard</h1>
<p>Welcome to the student management system.</p>
<a href="student/register.php" class="btn btn-primary">Register New Student</a>
<a href="logout.php" class="btn btn-danger">Logout</a>
<?php include 'footer.php'; ?>
