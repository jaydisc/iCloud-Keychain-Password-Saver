<?php
// Set the parent domain
$parent_domain = 'passwords.practiceofcode.com';

if (isset($_POST['keyword']))
{
	// If a keyword has been submitted, redirect to it.
	if (!empty($_POST['keyword']))
	{
		header('Location: https://' . urlencode($_POST['keyword']) . '.' . $parent_domain);
	}
	else
	{
		header('Location: https://' . $parent_domain);
	}
	exit();
}
elseif (!empty($_POST['password']))
{
	// If a password has been submitted, redirect back to the same location (to avoid refresh/resend form alerts)
	header('Location: /');
	exit();
}

// Has a keyword been set?
$keyword = FALSE;
if (strpos($_SERVER['SERVER_NAME'], $parent_domain) >= 2)
{
	$keyword = str_replace('.' . $parent_domain, '', $_SERVER['SERVER_NAME']);
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>iCloud Keychain Password Saver</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		* {
			box-sizing: border-box;
		}
		body {
			padding-left: 10px;
			padding-right: 10px;
			font: 0.9em Helvetica, Arial, sans-serif;
			line-height: 1.4;
			text-align: center;
		}
		p, fieldset {
			text-align: left;
		}
		fieldset {
			border: 0;
			background-color: #eee;
			margin-top: 30px;
			margin-bottom: 30px;
		}
		legend {
			background-color: #ccc;
			padding: 5px 10px;
		}
		label {
			display: block;
			margin-bottom: 0.25em;
			font-size: 0.85em;
			font-weight: bold;
		}
		input {
			font-size: 16px;
			margin-bottom: 0.5em;
			margin-left: 0;
			margin-right: 0;
		}
		
		.row {
			display: inline-block;
			max-width: 1024px;
			width: 100%;
			margin-left: -15px;
			margin-right: -15px;
		}
		.row:after {
			content: ' ';
			display: table;
			clear: both;
		}
		.col {
			padding-left: 15px;
			padding-right: 15px;
		}
		@media (min-width: 768px) {
			.col {
				width: 50%;
				float: left;
				padding-left: 15px;
				padding-right: 15px;
			}
		}
	</style>
	<script>
		// Form validation
		function submit_form() {
			if (document.getElementById('password').value == '')
			{
				alert('You must enter a password.');
				return false;
			}
			
			// Disable the username field if it's empty.
			if (document.getElementById('username').value == '')
			{
				document.getElementById('username').disabled = true;
			}
			return true;
		}
	</script>
</head>
<body>
	<div class="row">
		
		<?php if ($keyword): ?>
		
		<div class="col">
			<form action="/" method="post" accept-charset="utf-8" onsubmit="return submit_form();">
				<fieldset>
					<legend>Login</legend>
					<p>Enter the credentials to save for the keyword, <strong>“<?php echo $keyword; ?>”</strong>.</p>
					<p>
						<label for="username">Username/Email (optional)</label>
						<input type="text" name="username" value="" id="username" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
						<br>
						<label for="password">Password</label>
						<input type="password" name="password" value="" id="password" required>
						<br>
						<input type="submit" name="submit" value="Register" id="register">
					</p>
				</fieldset>
			</form>
		</div>
		
		<?php endif ?>
		
		<div class="col">
			
			<form action="/" method="post" accept-charset="utf-8">
				<fieldset>
					<legend>New Keyword</legend>
					
					<?php if (!$keyword): ?>
				
					<p>Enter a keyword below. You will then be redirected to a hostname including that keyword. Then, Register your login credentials, and allow iCloud Keychain to save it. You can then search for, or ask Siri to give you, the password for that keyword.</p>
			
					<?php else: ?>
			
					<p>Choose a new keyword:</p>
			
					<?php endif ?>
					
					<p>
						<label for="keyword">Keyword</label>
						<input type="text" name="keyword" value="<?php echo $keyword; ?>" id="keyword" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" required>
						<br>
						<input type="submit" name="submit" value="Go" id="submit">
					</p>
				</fieldset>
			</form>
		</div>
	</div>
</body>
</html>