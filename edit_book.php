<?php
// Database connection
$host = 'localhost';
$db = 'library';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update the book in the database
    $id = $_POST['id'];
    $title = $conn->real_escape_string($_POST['title']);
    $author = $conn->real_escape_string($_POST['author']);
    $year = $_POST['year'];
    $genre = $conn->real_escape_string($_POST['genre']);

    $sql = "UPDATE books SET title='$title', author='$author', year='$year', genre='$genre' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Retrieve book details for the selected ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM books WHERE id=$id");
    $book = $result->fetch_assoc();
} else {
    header("Location: index.php");
    exit;
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Edit Book</title>
</head>
<body>
<div class="form-container">
    <h1>Edit Book</h1>
    <form method="post" action="edit_book.php">
        <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
        <label>Title:</label>
        <input type="text" name="title" value="<?php echo $book['title']; ?>" required><br>
        <label>Author:</label>
        <input type="text" name="author" value="<?php echo $book['author']; ?>" required><br>
        <label>Year:</label>
        <input type="number" name="year" value="<?php echo $book['year']; ?>" required><br>
        <label>Genre:</label>
        <input type="text" name="genre" value="<?php echo $book['genre']; ?>" required><br>
        <button type="submit">Update Book</button>
    </form>
    <div><br>
    <a href="index.php">Back to Book List</a>
</body>
</html>
