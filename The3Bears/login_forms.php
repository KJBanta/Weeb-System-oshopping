<?php
@include 'db_connect.php';

session_start();

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Plain text password

    // Query the users table for username and password match
    $select = "SELECT * FROM users WHERE username = '$username'";

    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        // Check password (since the passwords are stored as plain text, we just compare directly)
        if ($password == $row['Password']) {
            // Check user type and redirect accordingly
            if ($row['user_type'] == 'admin') {
                $_SESSION['admin_name'] = $row['username'];
                header('location:admin-index.php'); // Redirect to the admin dashboard
                exit();
            } elseif ($row['user_type'] == 'user') {
                $_SESSION['user_name'] = $row['username'];
                header('location:user-index.php'); // Redirect to user page
                exit();
            }
        } else {
            $error = 'Incorrect username or password!';
        }
    } else {
        $error = 'Incorrect username or password!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="background"></div>
    <div class="form-container">
        <div class="form-header">
            <img src="MAINPICS/ThreeBears_Logo.png" alt="Logo" class="logo">
            <h2 class="form-title">LOG-IN FORM</h2>
        </div>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <?php
            if (isset($error)) {
                echo '<p class="error-message">' . $error . '</p>';
            }
            ?>
            <div class="form-buttons">
                <a href="signup_forms.php" class="secondary-btn">I don't have an account.</a>
                <button type="submit" name="submit" class="secondary-btn">SUBMIT</button>
            </div>
        </form>
    </div>
    <footer class="footer">
        <a href="index.php" class="footer-link">Home</a>
        <a href="about-us.php" class="footer-link">About Us</a>
        <a href="contact-us.php" class="footer-link">Contact Us</a>
    </footer>
</body>
</html>