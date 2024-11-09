<?php
require '../functions.php';
guard();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_data = [
        'student_id' => $_POST['student_id'],
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name']
    ];

    $errors = validateStudentData($student_data);
    $errors = array_merge($errors, checkDuplicateStudentData($student_data));

    if (empty($errors)) {
        $_SESSION['student_data'][] = $student_data;
        header("Location: register.php");
        exit;
    }
}
?>

<?php include '../header.php'; ?>

<h1>Register Student</h1>
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

<?php
if (!empty($errors)) {
    echo "<div class='alert alert-danger mt-3'>" . implode('<br>', $errors) . "</div>";
}
?>

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
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="text-muted">No students registered yet.</p>
<?php endif; ?>

<?php include '../footer.php'; ?>
