<?php
require '../functions.php';
guard();

$index = $_GET['index'] ?? null;

if ($index === null || !isset($_SESSION['student_data'][$index])) {
    header("Location: register.php");
    exit;
}

$student = $_SESSION['student_data'][$index];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student['first_name'] = $_POST['first_name'];
    $student['last_name'] = $_POST['last_name'];

    $errors = validateStudentData($student);

    if (empty($errors)) {
        $_SESSION['student_data'][$index] = $student;
        header("Location: register.php");
        exit;
    }
}
?>

<?php include '../header.php'; ?>

<!-- Breadcrumbs -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="register.php">Register Student</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Student</li>
  </ol>
</nav>

<h1>Edit Student</h1>
<form action="edit.php?index=<?php echo $index; ?>" method="POST">
    <div class="form-group">
        <label for="student_id">Student ID</label>
        <input type="text" class="form-control" name="student_id" id="student_id" value="<?php echo htmlspecialchars($student['student_id']); ?>" readonly>
    </div>
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo htmlspecialchars($student['first_name']); ?>" required>
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo htmlspecialchars($student['last_name']); ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Student</button>
    <a href="register.php" class="btn btn-secondary">Cancel</a>
</form>

<?php
if (!empty($errors)) {
    echo "<div class='alert alert-danger mt-3'>" . implode('<br>', $errors) . "</div>";
}
?>

<?php include '../footer.php'; ?>
