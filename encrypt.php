
<?php
# This code sucks.
    $password = "password";
	$hash = md5($password);
    $key = pack('H*', $hash);
    $data = "do-re-mi-fa-sol";
    $key_size =  strlen($key);
    echo "Key size: " . $key_size . "\n";
	$garbage = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key , $data , MCRYPT_MODE_CBC);
	$content = base64_encode($garbage);
	echo $content;
	$plaintextprepare = base64_decode($content);
	    $plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $plaintext_prepare, MCRYPT_MODE_CBC);
?>
