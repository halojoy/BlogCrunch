<?php

$included = get_included_files();
if (pathinfo($included[0], PATHINFO_BASENAME) == 'install.php')
    exit('no');

if (is_file('data/pdosqlite.db')) {
    header('location:index.php');
    exit();
}
// the heading to show at the top of the page
$site_heading = "Blog <i class=\"fa fa-rss\" aria-hidden=\"true\"></i> Crunch";

// show the header view
include_once "views/header.php";

echo 'Install and Create an Admin<br><br>';

if (isset($_POST['username'])) {

    // include the code for connecting to the database
    include_once "includes/database-connect.php";

    $sql = "CREATE TABLE IF NOT EXISTS `blog_entry` (
      `id` INTEGER PRIMARY KEY,
      `entry_title` TEXT,
      `entry_text`  TEXT,
      `entry_date`  TEXT,
      `author_id`   INTEGER,
      `image_url`   TEXT
    )";
    $connection->exec($sql);

    $sql = "CREATE TABLE IF NOT EXISTS `comments` (
      `comment_id` INTEGER PRIMARY KEY,
      `post_id`     INTEGER,
      `user_id`     INTEGER,
      `comment`     TEXT,
      `date_posted` TEXT
    )";
    $connection->exec($sql);

    $sql = "CREATE TABLE IF NOT EXISTS `users` (
      `user_id` INTEGER PRIMARY KEY,
      `username` TEXT UNIQUE COLLATE NOCASE,
      `email`    TEXT UNIQUE,
      `password` TEXT,
      `admin`    INTEGER DEFAULT 0
    )";
    $connection->exec($sql);
        
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $passhash = hash('sha256', $_POST['password']);

    $sql = "INSERT INTO users (username,  email, password, admin)
            VALUES ('$username', '$email', '$passhash', 1)";
    $connection->exec($sql);

    echo 'Install Admin & Create Tables done<br><br>';

    echo '<a href="admin.php">Goto Admin Login</a>';
    // show the footer view
    include_once "views/footer.php";
    exit();
}

?>
<form method="post">
<input name="username" placeholder="Admin Username" required><br>
<input name="email" placeholder="Admin Email" required><br>
<input name="password" type="password" placeholder="Admin Password" required><br>
<br>
<input type="submit">
</form>
<?php

// show the footer view
include_once "views/footer.php";
