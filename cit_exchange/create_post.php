<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $topic = $_POST['topic'];

        if ($title && $content && $topic) {
            $stmt = $conn->prepare("INSERT INTO posts (user_id, title, content, topic) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('isss', $user_id, $title, $content, $topic);

            if ($stmt->execute()) {
                header("Location: " . $_SERVER['HTTP_REFERER'] . "?message=Post created successfully");
                
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "All fields are required.";
        }
    } else {
        echo "You must be logged in to create a post.";
    }
}

$conn->close();
?>
