<?php

namespace Pingpp;

class Pingpp
{
    /**
     * @var string The Pingpp API key to be used for requests.
     */
    public static $apiKey;
    /**
     * @var string The base URL for the Pingpp API.
     */
    public static $apiBase = 'https://api.pingxx.com';
    /**
     * @var string|null The version of the Pingpp API to use for requests.
     */
    public static $apiVersion = "2015-10-10";
    /**
     * @var boolean Defaults to true.
     */
    public static $verifySslCerts = true;

    const VERSION = '2.1.3';

    /**
     * @var string The private key path to be used for signing requests.
     */
    public static $privateKeyPath;

    /**
     * @var string The PEM formatted private key to be used for signing requests.
     */
    public static $privateKey;

    /**
     * @return string The API key used for requests.
     */
    public static function getApiKey()
    {
        return self::$apiKey;
    }

    /**
     * Sets the API key to be used for requests.
     *
     * @param string $apiKey
     */
    public static function setApiKey($apiKey)
    {
        self::$apiKey = $apiKey;
    }

    /**
     * @return string The API version used for requests. null if we're using the
     *    latest version.
     */
    public static function getApiVersion()
    {
        return self::$apiVersion;
    }

    /**
     * @param string $apiVersion The API version to use for requests.
     */
    public static function setApiVersion($apiVersion)
    {
        self::$apiVersion = $apiVersion;
    }

    /**
     * @return boolean
     */
    public static function getVerifySslCerts()
    {
        return self::$verifySslCerts;
    }

    /**
     * @param boolean $verify
     */
    public static function setVerifySslCerts($verify)
    {
        self::$verifySslCerts = $verify;
    }

    /**
     * @return string
     */
    public static function getPrivateKeyPath()
    {
        return self::$privateKeyPath;
    }

    /**
     * @param string $path
     */
    public static function setPrivateKeyPath($path)
    {
        self::$privateKeyPath = $path;
    }


    /**
     * @return string
     */
    public static function getPrivateKey()
    {
        return self::$privateKey;
    }

    /**
     * @param string $key
     */
    public static function setPrivateKey($key)
    {
        self::$privateKey = $key;
    }
}
