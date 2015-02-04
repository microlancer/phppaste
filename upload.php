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
				#search-submit {
					flex: 0 0;
					align-self: center;
				}
			</style>
		</head>    
		<body>
				<form id="search-form" name="form" method="post">
				<textarea rows="30" cols="150" id="search-input" name="input"></textarea>
				<input name="utf8" type="submit" id="search-submit" value="Submit" />
			</form>
		</body>
	</html>	
	<?php
		if(isset($_POST['input'])) { 
			if(!isset($_REQUEST['input']) || strlen(trim($_REQUEST['input'])) == 0){	
			die("EMPTY");
			}
			$towrite = $_POST['input'];
			$filename = "/var/www/html/dump/" . md5($towrite);
			$fh = fopen($filename, 'w') or die("Fail!");
			fwrite($fh, chr(239).chr(187).chr(191).$towrite);
			fclose($fh);
			header('Location: http://localhost/dump/' . md5($towrite));			
		}
	?>
