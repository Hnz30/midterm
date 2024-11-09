<?php
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $errors = validateLoginCredentials($email, $password);

    if (empty($errors)) {
        $users = getUsers();
        if (checkLoginCredentials($email, $password, $users)) {
            $_SESSION['email'] = $email;
            header("Location: dashboard.php");
            exit;
        } else {
            $errors[] = "Invalid login credentials.";
        }
    }
}
?>

<?php include 'header.php'; ?>
<h1 class="mt-4">Login</h1>
<form action="index.php" method="POST">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>
<?php if (!empty($errors)) echo "<div class='alert alert-danger mt-3'>" . implode('<br>', $errors) . "</div>"; ?>
<?php include 'footer.php'; ?>
