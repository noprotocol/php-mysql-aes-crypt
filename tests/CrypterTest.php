<?php

use NoProtocol\Encryption\MySQL\AES\Crypter;
use PHPUnit\Framework\TestCase;

class AESEncryptTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Assert 'foobar' encrypts to 'iWSjHbqpoNOPS6p1FsyyZw==' with default method and secret key 'mysecretseedingkey'.
     */
    public function testItEncrypts()
    {
        $crypter = new Crypter('mysecretseedingkey');
        $result = $crypter->encrypt('foobar');
        $this->assertEquals('iWSjHbqpoNOPS6p1FsyyZw==', base64_encode($result));
    }

    /**
     * Assert 'iWSjHbqpoNOPS6p1FsyyZw==' decrypts to 'foobar' with default method and secret key 'mysecretseedingkey'.
     */
    public function testItDecrypts()
    {
        $crypter = new Crypter('mysecretseedingkey');
        $result = $crypter->decrypt(base64_decode('iWSjHbqpoNOPS6p1FsyyZw=='));
        $this->assertEquals('foobar', $result);
    }

    /**
     * Assert 'foobar' encrypts to 'tD2h0aC78o4kmlsSuA0LgQ==' with AES-192-ECB method and 'mysecretseedingkey'.
     */
    public function testItEncrypts192()
    {
        $crypter = new Crypter('mysecretseedingkey', 'AES-192-ECB');
        $result = $crypter->encrypt('foobar');
        $this->assertEquals('tD2h0aC78o4kmlsSuA0LgQ==', base64_encode($result));
    }

    /**
     * Assert 'tD2h0aC78o4kmlsSuA0LgQ==' decrypts to 'foobar' with AES-192-ECB method and 'mysecretseedingkey'.
     */
    public function testItDecrypts192()
    {
        $crypter = new Crypter('mysecretseedingkey', 'AES-192-ECB');
        $result = $crypter->decrypt(base64_decode('tD2h0aC78o4kmlsSuA0LgQ=='));
        $this->assertEquals('foobar', (string) $result);
    }

    /**
     * Assert 'foobar' encrypts to 'HHA+m+yrcEBpfRN7Q6GLkw==' with AES-256-ECB method and 'mysecretseedingkey'.
     */
    public function testItEncrypts256()
    {
        $crypter = new Crypter('mysecretseedingkey', 'AES-256-ECB');
        $result = $crypter->encrypt('foobar');
        $this->assertEquals('HHA+m+yrcEBpfRN7Q6GLkw==', base64_encode($result));
    }

    /**
     * Assert 'HHA+m+yrcEBpfRN7Q6GLkw==' decrypts to 'foobar' with AES-256-ECB method and 'mysecretseedingkey'.
     */
    public function testItDecrypts256()
    {
        $crypter = new Crypter('mysecretseedingkey', 'AES-256-ECB');
        $result = $crypter->decrypt(base64_decode('HHA+m+yrcEBpfRN7Q6GLkw=='));
        $this->assertEquals('foobar', $result);
    }
}
