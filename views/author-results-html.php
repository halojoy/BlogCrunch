<p><a href="index.php"><i class="fa fa-chevron-circle-left" aria-hidden="false"></i> Back to Blog</a></p>
<h2>Your results:</h2>
<p>You searched for posts by: <strong><?php echo $_GET['author']; ?></strong></p>
<p>Number of posts found: <strong><?php echo $number ?></strong></p>
<?php
include_once "views/blog-html.php";
