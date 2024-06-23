<?php
session_start();
require 'config.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $faculty_department = $conn->real_escape_string(trim($_POST['faculty-department']));
    $location = $conn->real_escape_string(trim($_POST['location']));
    $contact_no = $conn->real_escape_string(trim($_POST['contact-no']));
    $username = $_SESSION['name']; // Use the name stored in the session
    $user_id = $_SESSION['user_id'];

    // Check if the username already exists
    $stmt = $conn->prepare("SELECT id FROM staff WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error = "Username already exists. Please use another username.";
        $stmt->close();
    } else {
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO staff (user_id, faculty_department, location, contact_no, username) VALUES (?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("issss", $user_id, $faculty_department, $location, $contact_no, $username);

            if ($stmt->execute()) {
                header("Location: login.php");
                exit();
            } else {
                $error = "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $error = "Error preparing statement: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Staff - Bus Routing System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Bus Routing System - University of Vavuniya</h1>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="register-form">
                <h2>Register Staff</h2>
                <?php if ($error): ?>
                    <div class="error-message"><?php echo $error; ?></div>
                <?php endif; ?>
                <form method="post" action="register-staff.php">
                    <div class="form-group">
                        <label for="faculty-department">Faculty/Department</label>
                        <input type="text" id="faculty-department" name="faculty-department" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" id="location" name="location" required>
                    </div>
                    <div class="form-group">
                        <label for="contact-no">Contact Number</label>
                        <input type="text" id="contact-no" name="contact-no" required>
                    </div>
                    <button type="submit" class="button">Register</button>
                </form>
                <button onclick="window.location.href='register.php'" class="button back-button">Back</button>
            </div>
        </div>
    </main>
</body>
</html>
