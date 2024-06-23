<?php
session_start();
require_once 'config.php';

// Initialize variables for error and success messages
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $name = $conn->real_escape_string(trim($_POST["name"]));
    $username = $conn->real_escape_string(trim($_POST["username"]));
    $email = $conn->real_escape_string(trim($_POST["email"]));
    $password = $conn->real_escape_string(trim($_POST["password"]));
    $position = $conn->real_escape_string(trim($_POST["position"]));

    // Validate form data
    if (empty($name) || empty($username) || empty($email) || empty($password) || empty($position)) {
        $error = "All fields are required.";
    } else {
        // Check if username or email already exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $error = "Username or email already exists. Please choose another.";
            $stmt->close();
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO users (name, username, email, password, position) VALUES (?, ?, ?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("sssss", $name, $username, $email, $hashed_password, $position);

                if ($stmt->execute()) {
                    $_SESSION['user_id'] = $stmt->insert_id;
                    $_SESSION['position'] = $position;
                    $_SESSION['name'] = $name; // Add this line to store the name in the session

                    if ($position == 'staff') {
                        header("Location: register-staff.php");
                    } else {
                        header("Location: register-student.php");
                    }
                    exit();
                } else {
                    $error = "Error: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                $error = "Error preparing statement: " . $conn->error;
            }
        }
    }
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Bus Routing System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Bus Routing System</h1>
            <h1>University of Vavuniya</h1>
        </div>
    </header>
    <main>
        <div class="container">
            <div class="register-form">
                <h2>Register</h2>
                <?php if ($error): ?>
                    <div class="message error"><?php echo $error; ?></div>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div class="message success"><?php echo $success; ?></div>
                <?php endif; ?>
                <form method="post" action="register.php">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="position">Position</label>
                        <select id="position" name="position" required>
                            <option value="staff">Staff</option>
                            <option value="student">Student</option>
                        </select>
                    </div>
                    <button type="submit" class="button">Next</button>
                </form>
                <button onclick="window.location.href='index.php'" class="button back-button">Back</button>
            </div>
        </div>
    </main>
</body>
</html>
