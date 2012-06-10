<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/basic_loader.php');

$template_data['title'] = 'JimDeno.com - Contact';
$template_data['meta']['description'] = 'Contact Jim Deno';
$template_data['user'] = $user;
$template_data['body_id'] = 'contact';
load_template('header', $template_data);
?>

<div id="main">
    <div id="content">
		<p>
			Use this form if you feel the need to contact me. Pending it isn't some ridiculous request,
			I should get back to you in a short amount of time.
		</p>

		<p id="contact-success" class="success hidden">Your message has been successfully sent.</p>
		<form id="contact-form" method="post" action="">
			<label for="email">Email:</label><br />
			<input id="email" class="required email" name="email" type="text" /><br class="clear" />

			<label for="subject">Subject:</label><br />
			<input id="subject" class="required" name="subject" type="text" /><br class="clear" />

			<label for="message">Message:</label><br />
			<textarea id="message" class="required" name="message"></textarea><br class="clear" />

			<input type="submit" id="submit-contact-form" value="Submit" />
		</form>
    </div>
</div>

<?php load_template('footer'); ?>
<script type="text/javascript" src="/js/jquery.validate.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#contact-form').validate({
			submitHandler: function() {
				$.ajax ({
					type: 'post',
					url: '/ajax/process_contact_form.php',
					data: $('#contact-form').serialize(),
					success: function(response) {
						// Process the response
						if (response == 'success') {
							$('#contact-success').show();
							$('#contact-form').hide();
						} else {
							var errors = $.parseJSON(response);

							errors.each(function() {
								alert($(this));
							});
						}
					}
				});
			}
		});
	});
</script>
</body>
</html>