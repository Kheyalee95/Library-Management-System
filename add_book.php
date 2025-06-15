<?php
// Database connection
$host = 'localhost';
$db = 'library';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $title = $conn->real_escape_string($_POST['title']);
    $author = $conn->real_escape_string($_POST['author']);
    $year = $_POST['year'];
    $genre = $conn->real_escape_string($_POST['genre']);

    // Insert data into the database
    $sql = "INSERT INTO books (title, author, year, genre) VALUES ('$title', '$author', '$year', '$genre')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h1 id="form_head">Add a New Book</h1>
        <form method="post" action="add_book.php">
            <label>Title:</label>
            <input type="text" name="title" required><br>
            <label>Author:</label>
            <input type="text" name="author" required><br>
            <label>Year:</label>
            <input type="number" name="year" required><br>
            <label>Genre:</label>
            <input type="text" name="genre" required><br>
            <button type="submit">Add Book</button>
        </form>
        <a href="index.php" class="back-link">Back to Book List</a>
    </div>
</body>
</html>
