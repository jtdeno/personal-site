<?php

function __autoload($name) {
    if (file_exists(CLASS_DIR . $name . '.class.php')) {
        require(CLASS_DIR . $name . '.class.php');
    } elseif (file_exists(ADMIN_CLASS_DIR . $name . '.class.php')) {
        require(ADMIN_CLASS_DIR . $name . '.class.php');
    } else {
        echo 'Class ' . $name . ' does not exist. Fix the autoloader!';
    }
}

function b($lines = 1) {
    $i = 0;
    while ($i < $lines) {
        echo '<br />';
        $i++;
    }
}

function load_template($name, $template_data = array()) {
    if (count($template_data > 0)) {
        foreach ($template_data as $key => $value) {
            $$key = $value;
        }
    }
    
    include(TEMPLATE_DIR . $name . '.template.php');
}

function redirect($location) {
    header('location: ' . $location);
    die;
}