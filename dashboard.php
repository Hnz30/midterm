<?php
session_start(); 
$pageTitle = "Dashboard";
if (empty($_SESSION['email'])) {
    header("Location: index.php");
    exit;
}

header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache");


include 'header.php'; 
include 'functions.php'; 

checkUserSessionIsActive();  

guard();  

?>
<main>
    <br>
    <div class="container d-flex justify-content-between align-items-center col-md-7">
        <h3>Welcome to the System: <?php echo $_SESSION['email']; ?></h3>
        <button onclick="window.location.href='logout.php'" class="btn btn-danger">Logout</button>
    </div>

    <!-- Register Student Card -->
    <div class="row justify-content-center mt-4">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h5>Register a Student</h5>
                </div>
                <div class="card-body">
                    <p class="justify-text-center">This section allows you to register a new student in the system. Click the button below to proceed with the registration process.</p>

                    <!-- Button to proceed to register a student -->
                    <div class="d-grid gap-2">
                        <a href="student/register.php" class="btn btn-primary w-100">Register a Student</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include 'footer.php';  
?>
