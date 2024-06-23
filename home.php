<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'config.php';

$user_id = $_SESSION['user_id'];
$location = '';

if ($_SESSION['position'] == 'staff') {
    $stmt = $conn->prepare("SELECT location FROM staff WHERE user_id = ?");
} else {
    $stmt = $conn->prepare("SELECT location FROM students WHERE user_id = ?");
}

if ($stmt) {
    $stmt->bind_param("i", $user_id);
    if ($stmt->execute()) {
        $stmt->bind_result($location);
        $stmt->fetch();
        $stmt->close();
    } else {
        $error = "Error executing statement: " . $stmt->error;
    }
} else {
    $error = "Error preparing statement: " . $conn->error;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Bus Routing System</title>
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
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?></h2>
            <p>Your current location: <?php echo htmlspecialchars($location); ?></p>
            <?php if (isset($error)) : ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <a href="change-location.php" class="button">Change Location</a>
            <a href="logout.php" class="button logout-button">Logout</a>
        </div>
    </main>
</body>
</html>
