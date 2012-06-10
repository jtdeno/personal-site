<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/basic_loader.php');

if ($user->logout()) {
    redirect('/index.php');
} else {
    echo 'some kinda error';
}