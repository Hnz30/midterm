<?php
session_start();
$pageTitle = "Register Student";
include '../header.php';  
include '../functions.php';  

$errors = [];
$student_data = [];

// Process the form submission for registering a student
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get student data from the form
    $student_data = [
        'student_id' => $_POST['student_id'],
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name']
    ];

    
    $errors = validateStudentData($student_data);

    // Check for duplicate student ID
    if (empty($errors)) {
        $duplicate = checkDuplicateStudentData($student_data);
        if (empty($duplicate)) {
            $_SESSION['student_data'][] = $student_data; 
            header("Location: register.php"); 
            exit;
        } else {
            $errors[] = "Duplicate Student ID.";
        }
    }
}
?>

<main>

    <div class="container justify-content-between align-items-center col-8">

    <h2 class=" m-4">Register a New Student</h2>

        <!-- breadcrumb -->
        <div class=" mt-4 w-100">
            <div class="bg-light p-2 mb-4 border r-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Register Student</li>
                    </ol>
                </nav>
            </div>
        </div>


        <!-- Display error messages only if the form was submitted and there are errors -->
        <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($errors)): ?>
            <?php echo renderErrorsToView(displayErrors($errors)); ?>
        <?php endif; ?>

        <!-- Student Registration Form with Gray Border -->
        <form method="POST" action="" class="border border-secondary-1 p-5 mb-4">
            <div class="mb-3">
                <label for="student_id" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Enter Student ID" >
            </div>

            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name">
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" >
            </div>

            <button type="submit" class="btn btn-primary ">Add Student</button>
        </form>

        <!-- List of Registered Students with Gray Border -->
        <?php if (!empty($_SESSION['student_data'])): ?>
            <div class="mt-3">
                <div class="border border-secondary-1 p-5 mb-4">
                    <h5>Student List</h5>
                    <hr>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION['student_data'] as $index => $student): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                                    <td><?php echo htmlspecialchars($student['first_name']); ?></td>
                                    <td><?php echo htmlspecialchars($student['last_name']); ?></td>
                                    <td>
                                        <!-- Edit Button -->
                                        <a href="edit.php?index=<?php echo $index; ?>" class="btn btn-info btn-sm">Edit</a>
                                        
                                        <!-- Delete Button -->
                                        <a href="delete.php?index=<?php echo $index; ?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else: ?>
        <?php endif; ?>
    </div>
</main>

<?php
include '../footer.php'; 
?>
