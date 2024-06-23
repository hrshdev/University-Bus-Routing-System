<?php
session_start();
require 'config.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $faculty = $conn->real_escape_string(trim($_POST['faculty']));
    $registration_no = $conn->real_escape_string(trim($_POST['registration-no']));
    $location = $conn->real_escape_string(trim($_POST['location']));
    $contact_no = $conn->real_escape_string(trim($_POST['contact-no']));
    $username = $_SESSION['name']; // Use the name stored in the session
    $user_id = $_SESSION['user_id'];

    // Check if the registration number already exists
    $stmt = $conn->prepare("SELECT id FROM students WHERE registration_no = ?");
    $stmt->bind_param("s", $registration_no);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error = "Registration number already exists. Please use another registration number.";
        $stmt->close();
    } else {
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO students (user_id, faculty, registration_no, location, contact_no, username) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("isssss", $user_id, $faculty, $registration_no, $location, $contact_no, $username);

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
    <title>Register Student - Bus Routing System</title>
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
                <h2>Register Student</h2>
                <?php if ($error): ?>
                    <div class="message error"><?php echo $error; ?></div>
                <?php endif; ?>
                <form method="post" action="register-student.php">
                    <div class="form-group">
                        <label for="faculty">Faculty</label>
                        <select id="faculty" name="faculty" required>
                            <option value="Applied Science">Applied Science</option>
                            <option value="Technological Studies">Technological Studies</option>
                            <option value="Business Studies">Business Studies</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="registration-no">Registration Number</label>
                        <input type="text" id="registration-no" name="registration-no" required>
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
