
<?php
    # --- ENCRYPTION ---

    # the key should be random binary, use scrypt, bcrypt or PBKDF2 to
    # convert a string into a key
    # key is specified using hexadecimal
    $password = "password";
	$hash = md5($password);
    $key = pack('H*', $hash);
    $data = "do-re-mi-ffa-sol";
    # show key size use either 16, 24 or 32 byte keys for AES-128, 192
    # and 256 respectively
    $key_size =  strlen($key);
    echo "Key size: " . $key_size . "\n";
    
	$garbage = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key , $data , MCRYPT_MODE_CBC);
	$content = base64_encode($garbage);
	echo $content;
?>
