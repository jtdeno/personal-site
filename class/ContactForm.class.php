<?php

class ContactForm extends Base {
	protected $id;
	protected $email;
	protected $subject;
	protected $message;

	public function save() {
		if (!isset($this->id)) {
			$query = '	INSERT INTO contact_emails
						(email, subject, message)
						VALUES (:email, :subject, :message)';

			$result = $this->_db->query($query)
						   ->bind(':email', $this->email)
						   ->bind(':subject', $this->subject)
						   ->bind(':message', $this->message)
						   ->execute();

			if ($result) {
				return true;
			} return false;
		}
	}

	public function send() {
		if (mail('jim@jimdeno.com', $this->subject, 'From: ' . $this->email . "\n" . $this->message)) {
			return true;
		} return false;
	}
}