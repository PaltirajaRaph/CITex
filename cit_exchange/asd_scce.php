<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>CITex</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<!-- NavBar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">CITex</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="ibda_iee.php">IBDA/IEE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="bms_cfp.php">BMS/CFP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="asd_scce.php">ASD/SCEE</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['username'])): ?>
                    <li class="nav-item">
                        <a class="nav-link">Welcome, <?php echo $_SESSION['username']; ?>!</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.html">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.html">Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div class="container-fluid">
    <div class="row">
    <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="asd_scce.php?topic=Sustainable Architecture">Sustainable Architecture</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="asd_scce.php?topic=Green Building">Green Building</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="asd_scce.php?topic=Smart Construction">Smart Construction</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="asd_scce.php?topic=Civil Engineering">Civil Engineering</a>
                </li>
            </ul>
        </div>
    </nav>

        <!-- Main Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <?php if (isset($_SESSION['username'])): ?>
                <form action="create_post.php" method="post" class="mt-4">
                    <div class="form-group">
                        <label for="title">Post Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Post title" required>
                    </div>
                    <div class="form-group">
                        <label for="content">Post Content</label>
                        <textarea class="form-control" id="content" name="content" placeholder="Post content" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="topic">Topic</label>
                        <select class="form-control" name="topic" id="topic">
                            <option value="Sustainable Architecture">Sustainable Architecture</option>
                            <option value="Green Building">Green Building</option>
                            <option value="Smart Construction">Smart Construction</option>
                            <option value="Civil Engineering">Civil Engineering</option>
                        </select>
                    </div>
                    <button type="submit" class="button">Create Post</button>
                </form>
            <?php endif; ?>
            <div id="posts">
                <?php include 'view_posts.php'; ?>
            </div>
        </main>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
