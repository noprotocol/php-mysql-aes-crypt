<?php

use NoProtocol\Encryption\MySQL\AES\Crypter;

class AESEncryptTest extends \PHPUnit_Framework_TestCase {

	public function setUp() {
		parent::setUp();
	}

    public function testItEncrypts() {
    	$crypter = new Crypter('mysecretseedingkey');
    	$result = $crypter->encrypt('foobar');
        print_r($result);
    	$this->assertEquals('iWSjHbqpoNOPS6p1FsyyZw==', base64_encode($result));
    }

    public function testItDecrypts() {
    	$crypter = new Crypter('mysecretseedingkey');
    	$result = $crypter->decrypt(base64_decode('iWSjHbqpoNOPS6p1FsyyZw=='));
    	$this->assertEquals('foobar', $result);
    }
}