	<!DOCTYPE html>
	<html>
		<head>
			<title>Encrypt</title>
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
				<input name="utf8" type="submit" id="search-submit" value="Submit">
			</form>
		</body>
	</html>
<?php
		if(isset($_POST['input'])) {
		if(!isset($_REQUEST['input']) || strlen(trim($_REQUEST['input'])) == 0){ die("Please enter something..."); }

# This code sucks.
    $password = "passwordf";
	$hash = $password;
	$key = $hash;
    $data = $_POST['input'];
    $key_size =  strlen($key);
    echo "<pre>";
    echo "Key size: " . $key_size . PHP_EOL;
	$garbage = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key , $data , MCRYPT_MODE_CBC);
	$content = base64_encode($garbage);
	echo $content . PHP_EOL;
	$plaintextprepare = base64_decode($content);
	$plaintext_decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $plaintextprepare, MCRYPT_MODE_CBC);
	echo $plaintext_decrypted . PHP_EOL ;
	echo "</pre>";
    $diff = $max - $min;
    if ($diff < 0 || $diff > 0x7FFFFFFF) {
	throw new RuntimeException("Bad range");
    }
    $bytes = mcrypt_create_iv(4, MCRYPT_DEV_URANDOM);
    if ($bytes === false || strlen($bytes) != 4) {
        throw new RuntimeException("Unable to get 4 bytes");
    }
    $ary = unpack("Nint", $bytes);
    $val = $ary['int'] & 0x7FFFFFFF;   // 32-bit safe
    $fp = (float) $val / 2147483647.0; // convert to [0,1]
    echo round($fp * $diff) + $min;

			}
?>
