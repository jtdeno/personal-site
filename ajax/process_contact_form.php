<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/basic_loader.php');

$errors = array();
if (!isset($_POST['email']) || $_POST['email'] == '') {
	$errors[] = 'Please enter an email address';
} elseif (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
	$errors[] = 'You\'ve entered an invalid email address';
}
if (!isset($_POST['subject']) || $_POST['subject'] == '') {
	$errors[] = 'Please enter a subject';
}
if (!isset($_POST['message']) || $_POST['message'] == '') {
	$errors[] = 'Please enter a message';
}

if (count($errors) < 1) {
	$contact_form = new ContactForm();
	$contact_form->email = $_POST['email'];
	$contact_form->subject = $_POST['subject'];
	$contact_form->message = $_POST['message'];

	if ($contact_form->send()) {
		$contact_form->save();
		echo 'success';
		die;
	} else {
		$errors[] = 'Unknown error sending message';
	}
}

echo json_encode($errors);

