<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/basic_loader.php');
require_once(ADMIN_INCLUDES . 'admin_loader.php');

$logReader = new LogReader();
$logReader->setSearch('PHP Notice', '#E3DF09');
$logReader->setSearch('PHP Warning', '#F5B505');
$logReader->setSearch('PHP Fatal error', '#FF0000');
$logReader->linesToRead = 100;
$logReader->logPath = ERROR_LOG_PATH;

$template_data['title'] = 'JimDeno.com - Admin - View Error Log';
$template_data['user'] = $user;
load_template('header', $template_data);
?>

<div id="main">
    <div id="content" class="system_error">
        <?php
        $logReader->prettyPrint();
        ?>
    </div>
</div>

<?php load_template('footer'); ?>
</body>
</html>