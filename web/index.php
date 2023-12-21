<?php
session_start();
require_once('koneksi.php');
// Check login status
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
// C - Create
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {
    $newUsername = $_POST['newUsername'];
    $newPassword = $_POST['newPassword'];

    $sqlCreate = "INSERT INTO users (username, password) VALUES ('$newUsername', '$newPassword')";
    $resultCreate = $conn->query($sqlCreate);
}

// R - Read
$sqlRead = "SELECT * FROM users";
$resultRead = $conn->query($sqlRead);

// U - Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $userIdToUpdate = $_POST['userIdToUpdate'];
    $updatedUsername = $_POST['updatedUsername'];
    $updatedPassword = $_POST['updatedPassword'];

    $sqlUpdate = "UPDATE users SET username='$updatedUsername', password='$updatedPassword' WHERE id=$userIdToUpdate";
    $resultUpdate = $conn->query($sqlUpdate);

    header("Location: index.php");
    exit();
}

// D - Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $userIdToDelete = $_POST['userIdToDelete'];

    $sqlDelete = "DELETE FROM users WHERE id=$userIdToDelete";
    $resultDelete = $conn->query($sqlDelete);

    // Redirect back to the same page after deletion
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Example</title>
</head>
<body>
    <h2>CRUD Example</h2>

    <!-- Create Form -->
    <form method="post" action="index.php">
        <h3>Create User</h3>
        <label for="newUsername">Username:</label>
        <input type="text" name="newUsername" required><br>

        <label for="newPassword">Password:</label>
        <input type="password" name="newPassword" required><br>

        <button type="submit" name="create">Create User</button>
    </form>

    <!-- Read Users -->
    <h3>Read Users</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Action</th>
        </tr>
        <?php
        while ($row = $resultRead->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['password']}</td>
                    <td>
                        <form method='post' action='index.php'>
                            <input type='hidden' name='userIdToUpdate' value='{$row['id']}'>
                            <label for='updatedUsername'>New Username:</label>
                            <input type='text' name='updatedUsername' required>
                            <label for='updatedPassword'>New Password:</label>
                            <input type='password' name='updatedPassword' required>
                            <button type='submit' name='update'>Update</button>
                        </form>
                        <form method='post' action='index.php'>
                            <input type='hidden' name='userIdToDelete' value='{$row['id']}'>
                            <button type='submit' name='delete'>Delete</button>
                        </form>
                    </td>
                  </tr>";
        }
        ?>
    </table>

    <!-- Logout -->
    <br>
    <a class="menuNavbar" href="logout.php">Logout</a>
</body>
</html>