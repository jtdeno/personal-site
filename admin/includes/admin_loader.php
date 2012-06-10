<?php

if ($user->role != 'Administrator') {
    redirect('/admin/login.php');
}