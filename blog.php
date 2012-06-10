<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/basic_loader.php');

$template_data['title'] = 'JimDeno.com - Blog';
$template_data['user'] = $user;
$template_data['body_id'] = 'blog';

$blog_post_list = BlogPostList::get_blog_posts();

load_template('header', $template_data);
?>

<div id="main">
    <div id="content">
		<?php
		if ($blog_post_list) {
			foreach ($blog_post_list as $blog_post) {
				echo '<h3>' . $blog_post->title . '</h3>';

				echo '<p>' . $blog_post->content . '</p>';
			}
		}
		?>
    </div>
</div>

<?php load_template('footer'); ?>
</body>
</html>