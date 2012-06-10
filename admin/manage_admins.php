<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/basic_loader.php');
require_once(ADMIN_INCLUDES . 'admin_loader.php');

$template_data['title'] = 'JimDeno.com - Admin - Manage Admins';
$template_data['user'] = $user;
load_template('header', $template_data);
?>

<div id="main">
    <div id="content">
        <?php $user->getUsers(array('role' => 'Administrator')); ?>
    </div>
</div>

<?php load_template('footer'); ?>
</body>
</html>