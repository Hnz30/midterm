<?php
require '../functions.php';
guard();

// Handle form submission for student registration
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_data = [
        'student_id' => $_POST['student_id'],
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
    ];

    $errors = validateStudentData($student_data);

    if (empty($errors)) {
        // Check for duplicate student IDs
        if (checkDuplicateStudentData($student_data)) {
            $errors[] = 'Duplicate Student ID';
        } else {
            // Save the student data into the session
            $_SESSION['student_data'][] = $student_data;
            header("Location: register.php");
            exit;
        }
    }
}
?>

<?php include '../header.php'; ?>

<!-- Breadcrumbs -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Register Student</li>
  </ol>
</nav>

<h1>Register Student</h1>

<!-- Display errors -->
<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php echo implode('<br>', $errors); ?>
    </div>
<?php endif; ?>

<form action="register.php" method="POST">
    <div class="form-group">
        <label for="student_id">Student ID</label>
        <input type="text" class="form-control" name="student_id" id="student_id" placeholder="Student ID" required>
    </div>
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" required>
    </div>
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" required>
    </div>
    <button type="submit" class="btn btn-success">Register</button>
</form>

<hr>

<h2>Registered Students</h2>

<?php if (!empty($_SESSION['student_data'])): ?>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($_SESSION['student_data'] as $index => $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                    <td><?php echo htmlspecialchars($student['first_name']); ?></td>
                    <td><?php echo htmlspecialchars($student['last_name']); ?></td>
                    <td>
                        <a href="edit.php?index=<?php echo $index; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="delete.php?index=<?php echo $index; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="text-muted">No students registered yet.</p>
<?php endif; ?>

<?php include '../footer.php'; ?>
