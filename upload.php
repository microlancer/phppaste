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
			if(!isset($_REQUEST['input']) || strlen(trim($_REQUEST['input'])) == 0){
			die("EMPTY");
			}
			if (md5($_POST['password']) === 'MD5HASHHERE' ) { 
			}
			else
			{
			die("WRONGPASSWORD");
			}
			$towrite = $_POST['input'];
			$md5 = md5($towrite);
			$filename = "/var/www/html/dump/" . $md5;
			$fh = fopen($filename, 'w') or die("Fail!");
			fwrite($fh, chr(239).chr(187).chr(191).$towrite);
			fclose($fh);
			header('Location: http://localhost/dump/' . $md5);
		}
	?>
