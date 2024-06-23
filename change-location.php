<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'config.php';

$user_id = $_SESSION['user_id'];
$newLocation = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['location'])) {
        $newLocation = htmlspecialchars($_POST['location']);

        if ($_SESSION['position'] == 'staff') {
            $stmt = $conn->prepare("UPDATE staff SET location = ? WHERE user_id = ?");
        } else {
            $stmt = $conn->prepare("UPDATE students SET location = ? WHERE user_id = ?");
        }

        if ($stmt) {
            $stmt->bind_param("si", $newLocation, $user_id);
            if ($stmt->execute()) {
                $_SESSION['location'] = $newLocation;
                $stmt->close();
                header("Location: home.php");
                exit();
            } else {
                $error_message = "Error executing statement: " . $stmt->error;
            }
        } else {
            $error_message = "Error preparing statement: " . $conn->error;
        }
    } else {
        $error_message = "Location field cannot be empty.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Location - Bus Routing System</title>
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
            <h2>Change Location</h2>
            <?php if (!empty($error_message)) : ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <form method="post">
                <div class="form-group">
                    <label for="location">New Location</label>
                    <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($newLocation); ?>" required>
                </div>
                <button type="submit" class="button">Update</button>
            </form>
        </div>
    </main>
</body>
</html>
