<?php
@include 'db_connect.php'; // Ensure correct file path

$error = []; // Initialize error array

if (isset($_POST['submit'])) {

    // Sanitize user input
    $firstname = mysqli_real_escape_string($conn, $_POST['FirstName']);
    $lastname = mysqli_real_escape_string($conn, $_POST['LastName']);
    $mi = mysqli_real_escape_string($conn, $_POST['MI']);
    $address = mysqli_real_escape_string($conn, $_POST['Address']);
    $contactnum = mysqli_real_escape_string($conn, $_POST['Contactnum']);
    $gender = mysqli_real_escape_string($conn, $_POST['Gender']);
    $username = mysqli_real_escape_string($conn, $_POST['username']); // Get the username
    $password = mysqli_real_escape_string($conn, $_POST['password']); // Get the password
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']); // Get the confirmation password

    // Validate that Contact number contains only numbers
    if (!preg_match('/^[0-9]+$/', $contactnum)) {
        $error[] = 'Contact number should only contain digits.';
    }

    // Check if the passwords match
    if ($password !== $confirm_password) {
        $error[] = 'Passwords do not match.';
    }

    // If no errors, proceed with the database operations
    if (empty($error)) {
        // Check if the customer already exists
        $select = "SELECT * FROM customer_info WHERE Fname = '$firstname' AND Lname = '$lastname' AND Contact_num = '$contactnum'";
        $result = mysqli_query($conn, $select);

        if (mysqli_num_rows($result) > 0) {
            $error[] = 'Customer already exists!';
        } else {
            // Insert customer into the customer_info table
            $insert_customer = "INSERT INTO customer_info (Fname, Lname, MI, Address, Contact_num, Gender, user_type) 
                                VALUES ('$firstname', '$lastname', '$mi', '$address', '$contactnum', '$gender', 'user')";
            
            if (mysqli_query($conn, $insert_customer)) {
                // Get the last inserted Customer_ID
                $customer_id = mysqli_insert_id($conn);

                // Insert into the users table
                $insert_user = "INSERT INTO users (username, Password, user_type, Customer_ID) 
                                VALUES ('$username', '$password', 'user', '$customer_id')";

                if (mysqli_query($conn, $insert_user)) {
                    // Set a success message in the session
                    session_start();
                    $_SESSION['success_message'] = 'Registration successful! You can now log in.';
                    
                    // Redirect to login page
                    header('Location: login_forms.php');
                    exit(); // Ensure the script stops execution after the redirect
                } else {
                    $error[] = 'Failed to register user!';
                }
            } else {
                $error[] = 'Failed to register customer!';
            }
        }
    }
}
?>

<!-- Display errors if any -->
<?php if (!empty($error)): ?>
    <div style="color: red; font-weight: bold; text-align: center;">
        <?php foreach ($error as $err): ?>
            <p><?php echo $err; ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="background"></div>
    <div class="form-container">
        <div class="form-header">
            <img src="MAINPICS/ThreeBears_Logo.png" alt="Logo" class="logo">
            <h2 class="form-title">SIGN-UP FORM</h2>
        </div>
        <form action="" method="POST">
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" id="FirstName" name="FirstName" placeholder="Enter your First Name" value="<?php echo isset($_POST['FirstName']) ? $_POST['FirstName'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" id="LastName" name="LastName" placeholder="Enter your Last Name" value="<?php echo isset($_POST['LastName']) ? $_POST['LastName'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="middlei">Middle Initial:</label>
                <input type="text" id="MI" name="MI" maxlength="1" placeholder="Enter your Middle Initial" value="<?php echo isset($_POST['MI']) ? $_POST['MI'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="Address" name="Address" placeholder="Enter your Address" value="<?php echo isset($_POST['Address']) ? $_POST['Address'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="ContactNo">Contact Number:</label>
                <input type="text" id="Contactnum" name="Contactnum" placeholder="Enter your Contact Number" value="<?php echo isset($_POST['Contactnum']) ? $_POST['Contactnum'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="Gender">Gender:</label>
                <input type="text" id="Gender" name="Gender" placeholder="Enter your Gender" value="<?php echo isset($_POST['Gender']) ? $_POST['Gender'] : ''; ?>" required>
            </div>

            <!-- Username and Password Fields -->
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter your Username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter your Password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your Password" required>
            </div>

            <!-- Error Messages -->
            <?php
            if (isset($error)) {
                foreach ($error as $err) {
                    echo '<p class="error-message">' . $err . '</p>';
                }
            }
            ?>

            <div class="form-buttons">
                <a href="login_forms.php" class="secondary-btn">I already have an account.</a>
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
