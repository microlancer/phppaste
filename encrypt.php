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
$data = $_POST['input'];
$password = mcrypt_create_iv(32, MCRYPT_DEV_URANDOM);
$key_size =  strlen($password);
echo "<pre>";
echo "Key size: " . $key_size . PHP_EOL;
$garbage = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $password , $data , MCRYPT_MODE_CBC);
$content = base64_encode($garbage);
echo "The encrypted content is: " . $content . PHP_EOL;
$plaintextprepare = base64_decode($content);
$plaintext_decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $password, $plaintextprepare, MCRYPT_MODE_CBC);
echo "The decrypted content is: " . $plaintext_decrypted . PHP_EOL;
echo "The password is: " . base64_encode($password) . PHP_EOL;
echo "</pre>";
}
?>
