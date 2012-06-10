<?php
require($_SERVER['DOCUMENT_ROOT'].'/includes/basic_loader.php');
require(ADMIN_INCLUDES . 'admin_loader.php');

$template_data['title'] = 'JimDeno.com - New Blog Post';
$template_data['user'] = $user;
load_template('header', $template_data);

if (isset($_GET['id'])) {
	$blog_post = BlogPost::create_from_id($_GET['id']);
}

if (isset($_POST['submit_post'])) {
	if (!isset($blog_post)) {
        $blog_post = new BlogPost();
    }

    $blog_post->user_id = $user->id;
    $blog_post->title   = $_POST['title'];
    $blog_post->content = $_POST['body'];

    if ($blog_post->save()) {
        echo 'Blog post saved!';
    }
}
?>

<div id="main">
    <div id="content">
        <form action="" method="post">
            <label for="title">Title:</label>
            <input id="title" name="title" type="text" value="<?php echo isset($blog_post->title) ? $blog_post->title : ''; ?>"
				   size="60" /><br />

            <label for="body">Body:</label>
            <textarea id="body" name="body" cols="80" rows="20"><?php echo isset($blog_post->content) ? $blog_post->content : ''; ?></textarea><br />

            <input type="submit" name="submit_post" value="Submit" />
        </form>
    </div>
</div>

<?php load_template('footer'); ?>
<script type="text/javascript" src="/js/tiny_mce/tiny_mce.js" ></script>
<script type="text/javascript" >
tinyMCE.init({
        mode : "textareas",
        theme : "simple"   //(n.b. no trailing comma, this will be critical as you experiment later)
});
</script>
</body>
</html>