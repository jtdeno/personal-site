<?php
require($_SERVER['DOCUMENT_ROOT'].'/includes/basic_loader.php');

$template_data['title'] = 'JimDeno.com - Page Not Found';
$template_data['user'] = $user;
load_template('header', $template_data);
?>

    <div id="main">
        Oops! The page you're looking for couldn't be found. Please click the back button in your browser and try again.
    </div>

</div>

<?php load_template('footer'); ?>
</body>
</html>