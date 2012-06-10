<?php
require($_SERVER['DOCUMENT_ROOT'].'/includes/basic_loader.php');
require(ADMIN_INCLUDES . 'admin_loader.php');

$template_data['title'] = 'JimDeno.com - View Blog Posts';
$template_data['user'] = $user;
load_template('header', $template_data);

$blog_posts = BlogPostList::get_blog_posts();
?>

<div id="main">
    <div id="content">
        <?php
        if ($blog_posts) {
            echo '  <table>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Date Created</th>
                            <th>Actions</th>
                        </tr>';
                        foreach ($blog_posts as $blog_post) {
                            echo '  <tr>
                                        <td>' . $blog_post->id . '</td>
                                        <td>' . $blog_post->title . '</td>
                                        <td>' . $blog_post->content . '</td>
                                        <td>' . $blog_post->date_created->format('m/d/Y') . '</td>
                                        <td>
                                            <a href="modify_blog_post.php?id=' . $blog_post->id . '">Edit</a>
                                        </td>
                                    </tr>';
                        }
            echo '  </table>';
        } else {
            echo 'There are no blog posts.';
        }
        ?>
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