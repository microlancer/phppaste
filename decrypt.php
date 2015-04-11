	<!DOCTYPE html>
	<html>
		<head>
			<title>Decrypt</title>
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
					<pre id="passwordlabel" >Enter the password below!</pre>
					<textarea rows="1" cols="2" id="password" name="password"></textarea>
					<input name="utf8" type="submit" id="search-submit" value="Submit">
			</form>
		</body>
	</html>
<?php
		if(isset($_POST['input'])) {
		if(!isset($_REQUEST['input']) || strlen(trim($_REQUEST['input'])) == 0){ die("Please enter something..."); }
	echo "<pre>";
	$key = $_POST['password'];
	$content = $_POST['input'];
	$plaintextprepare = base64_decode($content);
	$plaintext_decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $plaintextprepare, MCRYPT_MODE_CBC);
	echo $plaintext_decrypted . PHP_EOL ;
	echo "</pre>";
			}
?>

