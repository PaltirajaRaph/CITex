<?php
session_start();

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['post_id']) && isset($_POST['title']) && isset($_POST['content'])) {
        $post_id = $_POST['post_id'];
        $title = $conn->real_escape_string($_POST['title']);
        $content = $conn->real_escape_string($_POST['content']);

        $sql = "UPDATE posts SET title='$title', content='$content' WHERE id='$post_id'";

        if ($conn->query($sql) === TRUE) {
            header("Location: " . $_SERVER['HTTP_REFERER'] . "?message=Post updated successfully");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Required fields are missing.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>
