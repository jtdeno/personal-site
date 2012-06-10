<?php
require($_SERVER['DOCUMENT_ROOT'].'/includes/basic_loader.php');
require(ADMIN_INCLUDES . 'admin_loader.php');

$template_data['title'] = 'JimDeno.com - Admin Section';
$template_data['user'] = $user;
load_template('header', $template_data);
?>

    <div id="main">
        <a href="modify_blog_post.php">New Blog Post</a><br />
        <a href="view_blog_posts.php">View Blog Posts</a><br />
        <a href="view_error_log.php">View Error Log</a>
    </div>

</div>

<?php load_template('footer'); ?>
</body>
</html>