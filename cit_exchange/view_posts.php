<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    include 'db.php';

    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    $selectedTopic = isset($_GET['topic']) ? $_GET['topic'] : '';
    
    // Determine which page we're on by checking the current file
    $currentPage = basename($_SERVER['PHP_SELF']);
    $topicFilter = '';
    
    // Set topic filter based on the current page
    if ($currentPage == 'ibda_iee.php') {
        $ibdaIeeTopics = "'Web Programming', 'Microcontrollers', 'Object Oriented Programming', 'System Database'";
        $topicFilter = "posts.topic IN ($ibdaIeeTopics)";
    } elseif ($currentPage == 'bms_cfp.php') {
        $bmsCfpTopics = "'Genomics', 'Biotechnology', 'Nutrition', 'Food Processing'";
        $topicFilter = "posts.topic IN ($bmsCfpTopics)";
    } elseif ($currentPage == 'asd_scce.php') {
        $asdScceTopics = "'Sustainable Architecture', 'Green Building', 'Smart Construction', 'Civil Engineering'";
        $topicFilter = "posts.topic IN ($asdScceTopics)";
    }

    if ($selectedTopic) {
        $sql = "SELECT posts.id, posts.title, posts.content, posts.topic, posts.created_at, users.username
                FROM posts
                JOIN users ON posts.user_id = users.id
                WHERE posts.topic = '$selectedTopic'
                ORDER BY posts.created_at DESC";
    } 
    else {
        $sql = "SELECT posts.id, posts.title, posts.content, posts.topic, posts.created_at, users.username
                FROM posts
                JOIN users ON posts.user_id = users.id";
        
        // Add the topic filter if we're on a specific department page
        if ($topicFilter) {
            $sql .= " WHERE $topicFilter";
        }
        
        $sql .= " ORDER BY posts.created_at DESC";
    }

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        echo "<h2>Posts for the topic: " . ($selectedTopic ? $selectedTopic : 'All Topics') . "</h2>";
        while ($row = $result->fetch_assoc()) {
            echo displayPost($row, $conn);
        }
    } else {
        echo "<p>No posts found for the selected topic.</p>";
    }

    if ($selectedTopic) {
        $sql = "SELECT posts.id, posts.title, posts.content, posts.topic, posts.created_at, users.username
                FROM posts
                JOIN users ON posts.user_id = users.id
                WHERE posts.topic != '$selectedTopic'";
        
        // Add department-specific filter to "Other Posts" section too
        if ($topicFilter) {
            $sql .= " AND $topicFilter";
        }
        
        $sql .= " ORDER BY posts.created_at DESC";
        
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo "<h2>Other Posts</h2>";
            while ($row = $result->fetch_assoc()) {
                echo displayPost($row, $conn);
            }
        }
    }

    $conn->close();

    function displayPost($row, $conn) {
        echo "<div class='post mb-4 post-container'>";
        echo "<small class='post-meta'>Post by " . htmlspecialchars($row['username']) . " on " . $row['created_at'] . "</small>";
        echo "<h2 class='post-title'>" . htmlspecialchars($row['title']) . "</h2>";
        echo "<p class='post-content'>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
        echo "<small class='post-topic'>Topic: " . htmlspecialchars($row['topic']) . "</small><br>";

        $post_id = $row['id'];
        $comment_sql = "SELECT comments.id, comments.content, comments.created_at, users.username
                        FROM comments
                        JOIN users ON comments.user_id = users.id
                        WHERE comments.post_id='$post_id'
                        ORDER BY comments.created_at DESC";
        $comment_result = $conn->query($comment_sql);

        echo "<div class='comments mt-3'>";
        while ($comment_row = $comment_result->fetch_assoc()) {
            echo "<div class='comment mb-2'>";
            echo "<small class='comment-meta'>Comment by " . htmlspecialchars($comment_row['username']) . " on " . $comment_row['created_at'] . "</small>";
            echo "<p class='comment-content'>" . nl2br(htmlspecialchars($comment_row['content'])) . "</p>";
    
            echo "</div>";
        }
        
        echo "</div>";
        if (isset($_SESSION['username'])) {
            echo "<div class='post-actions mt-3'>";
            echo "<button class='btn' data-toggle='modal' data-target='#updatePostModal' data-post-id='" . $row['id'] . "' data-post-title='" . htmlspecialchars($row['title']) . "' data-post-content='" . htmlspecialchars($row['content']) . "'>Update Post</button>";
            echo "<button class='btn' data-toggle='modal' data-target='#deletePostModal' data-post-id='" . $row['id'] . "'>Delete Post</button>";
            echo "</div>";
        }

        if (isset($_SESSION['username'])) {
            echo "<div class='form-container'>";
            echo "<form action='comment.php' method='post' class='mt-3'>";
            echo "<input type='hidden' name='post_id' value='$post_id'>";
            echo "<div class='form-group'>";
            echo "<textarea name='content' class='form-control' placeholder='Add a comment' required></textarea>";
            echo "</div>";
            echo "<button type='submit' class='btn btn-primary'>Comment</button>";
            echo "</form>";
            echo "</div>";
        }

        echo "</div>";
    }
    ?>

    <!-- Update Post Modal -->
    <div class="modal fade" id="updatePostModal" tabindex="-1" aria-labelledby="updatePostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatePostModalLabel">Update Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="update_post.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="post_id" id="update-post-id">
                        <div class="form-group">
                            <label for="post-title">Title</label>
                            <input type="text" class="form-control" id="update-post-title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="post-content">Content</label>
                            <textarea class="form-control" id="update-post-content" name="content" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Post Modal -->
    <div class="modal fade" id="deletePostModal" tabindex="-1" aria-labelledby="deletePostModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePostModalLabel">Delete Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="delete_post.php" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="post_id" id="delete-post-id">
                        <p>Are you sure you want to delete this post?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete Post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#updatePostModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var postId = button.data('post-id');
            var postTitle = button.data('post-title');
            var postContent = button.data('post-content');

            var modal = $(this);
            modal.find('#update-post-id').val(postId);
            modal.find('#update-post-title').val(postTitle);
            modal.find('#update-post-content').val(postContent);
        });

        $('#deletePostModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var postId = button.data('post-id');

            var modal = $(this);
            modal.find('#delete-post-id').val(postId);
        });
    </script>

</body>
</html>