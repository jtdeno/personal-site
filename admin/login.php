<?php
require($_SERVER['DOCUMENT_ROOT'].'/includes/basic_loader.php');

if($_POST) {
    if ($user->login($_POST['username'], $_POST['password']) !== false) {
        $message = '<span class="success"> You have successfully logged in </span>';
    } else {
        $message = '<span class="error"> You have entered either an incorrect username or password </span>';
    }
}

$template_data['title'] = 'JimDeno.com - Login';
$template_data['user'] = $user;
load_template('header', $template_data);
?>

<div id="main">
    <div id="content">
        <h2>Login</h2>

        <?php echo isset($message) ? $message : ''; ?>

        <form id="login_form" action="" method="post">
            <label for="username"> Username </label>
            <input id="username" type="text" name="username" /><br />

            <label for="password"> Password </label>
            <input id="password" type="password" name="password" /><br />

            <input type="submit" value="Submit" />
        </form>
    </div>
</div>

<?php load_template('footer'); ?>
</body>
</html>