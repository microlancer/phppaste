	<!DOCTYPE html>
	<html>
		<head>
			<title>PasteBin</title>
			<style>
				body {
					position: relative;
					margin: 10px;
				}
				#search-form {
					height: 100%;
					margin: 0;
					padding: 0;
					display: flex;
					flex-direction: column;
				}
				#search-input {
					flex: 1 1;
					margin-bottom: 10px;
				}
				#password {
					align-self: center;
					width: 100px;
				}
				#passwordlabel {
					align-self: center;
				}
				#search-submit {
					flex: 0 0;
					align-self: center;
				}
			</style>
		</head>
		<body>
				<form id="search-form" name="form" method="post">
				<textarea rows="30" cols="150" id="search-input" name="input"></textarea>
				<pre id="passwordlabel" >Enter the magic password below!</pre>
				<textarea rows="1" cols="2" id="password" name="password"></textarea>
				<input name="utf8" type="submit" id="search-submit" value="Submit">
			</form>
		</body>
	</html>
	<?php
		if(isset($_POST['input'])) {
			if(!isset($_REQUEST['input']) || strlen(trim($_REQUEST['input'])) == 0){ die("Please enter something..."); }
# Yes, the password is stored in plain text. But who cares, it's just to prevent someone from pasting "I'M ANONYMOUS SITE HACKED ZOMG" to your pastebin. 
# If your webserver gets powned and the password gets leaked, they can paste anyway
        	if ($_POST['password'] !== 'PASSWORDHERE' ) { die("Wrong password."); }
			$towrite = $_POST['input'];
			$hash = hash('sha256', $towrite);
			$filename = "/var/www/dump/" . $hash;
			$fh = fopen($filename, 'w') or die("Fail!");
			fwrite($fh, chr(239).chr(187).chr(191).$towrite);
			fclose($fh);
			header('Location: https://mirrors.justaguy.pw/dump/' . $hash);
		}
	?>
