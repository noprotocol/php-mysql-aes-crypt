<?php
/**
 * Encrypt/decrypt data to a format compatible with MySQL aes_encrypt() & aes_decrypt() functions.
 *
 * @package    NoProtocol\Encryption\MySQL\AES
 * @author     Bob Fanger <bob.fanger@noprotocol.nl>
 * @author     Anne Jan Brouwer <anne.jan.brouwer@noprotocol.nl>
 * @author     Govert Verschuur <govert.verschuur@noprotocol.nl>
 * @copyright  2016 NoProtocol
 * @license    https://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @link       http://www.smashingmagazine.com/2012/05/replicating-mysql-aes-encryption-methods-with-php/
 */

namespace NoProtocol\Encryption\MySQL\AES;

class Crypter {
    protected $key;

    function __construct($seed) {
        $this->key = $this->generateKey($seed);
    }

    /**
     * Encrypts the data
     *
     * @since 1.0
     * @param  string $data A string of data to encrypt.
     * @return (binary) string       The encrypted data
     */
    public function encrypt($data) {
        $pad_value = 16 - (strlen($data) % 16);
        $data = str_pad($data, (16 * (floor(strlen($data) / 16) + 1)), chr($pad_value));
        return @mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->key, $data, MCRYPT_MODE_ECB);
    }

    /**
     * Decrypts the data.
     *
     * @since 1.0
     * @param  string $data A (binary) string of encrypted data
     * @return string       Decrypted data
     */
    public function decrypt($data) {
        $data = @mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->key, $data, MCRYPT_MODE_ECB);
        return rtrim($data,"\x00..\x10");
    }

    /**
     * Create and set the key used for encryption.
     *
     * @since 1.0
     * @param  string $seed The seed used to create the key.
     * @return (binary) string the key to use in the encryption process.
     */
    protected function generateKey($seed) {
        $key = str_repeat(chr(0), 16);
        for ($i = 0, $len = strlen($seed); $i < $len; $i++) {
            $key[$i % 16] = $key[$i % 16] ^ $seed[$i];
        }

        return $key;
    }
}
