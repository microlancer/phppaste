
<?php
# This code sucks.
    $password = "password";
	$hash = md5($password);
    $key = pack('H*', $hash);
    $data = "do-re-mi-fa-sol";
    $key_size =  strlen($key);
    echo "Key size: " . $key_size . PHP_EOL;
	$garbage = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key , $data , MCRYPT_MODE_CBC);
	$content = base64_encode($garbage);
	echo $content . PHP_EOL;
	$plaintextprepare = base64_decode($content);
	$plaintext_decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $plaintextprepare, MCRYPT_MODE_CBC);
	echo $plaintext_decrypted . PHP_EOL ;
?>
