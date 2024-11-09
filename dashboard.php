<?php
require 'functions.php';
guard();
?>

<?php include 'header.php'; ?>

<!-- Breadcrumbs -->
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
  </ol>
</nav>

<h1>Welcome to the Dashboard</h1>
<p>Manage your students and other details here.</p>

<a href="student/register.php" class="btn btn-primary">Go to Register Student</a>

<?php include 'footer.php'; ?>

