<?php

use NoProtocol\Encryption\MySQL\AES\Crypter;
use PHPUnit\Framework\TestCase;

class AESEncryptTest extends TestCase {

	public function setUp()
	{
		parent::setUp();
	}

	public function testItEncrypts()
	{
    	$crypter = new Crypter('mysecretseedingkey');
    	$result = $crypter->encrypt('foobar');
    	$this->assertEquals('iWSjHbqpoNOPS6p1FsyyZw==', base64_encode($result));
    }

	public function testItDecrypts()
	{
    	$crypter = new Crypter('mysecretseedingkey');
    	$result = $crypter->decrypt(base64_decode('iWSjHbqpoNOPS6p1FsyyZw=='));
    	$this->assertEquals('foobar', $result);
    }
}