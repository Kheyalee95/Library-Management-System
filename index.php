<?php
// Database connection
$host = 'localhost';
$db = 'library';
$user = 'root';
$pass = ''; // Set your password if you have one
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete book if delete request is made
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM books WHERE id=$id");
    header("Location: index.php");
    exit;
}

// Fetch books from the database
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library Management System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>LIBRARY MANAGEMENT SYSTEM</h1><br>
    <h2>Books Available</h2><br>
    <table>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>
            <th>Genre</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['author']; ?></td>
            <td><?php echo $row['year']; ?></td>
            <td><?php echo $row['genre']; ?></td>
            <td>
                <a href="edit_book.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="index.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this book?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="add_book.php">Add a New Book</a>
</body>
</html>

<?php $conn->close(); ?>
