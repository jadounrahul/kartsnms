<?php

namespace KartsNMS\Authentication;

use KartsNMS\Config;
use KartsNMS\Interfaces\Authentication\Authorizer;

class LegacyAuth
{
    protected static $_instance;
    private static $configToClassMap = [
        'mysql' => 'KartsNMS\Authentication\MysqlAuthorizer',
        'active_directory' => 'KartsNMS\Authentication\ActiveDirectoryAuthorizer',
        'ldap' => 'KartsNMS\Authentication\LdapAuthorizer',
        'radius' => 'KartsNMS\Authentication\RadiusAuthorizer',
        'http-auth' => 'KartsNMS\Authentication\HttpAuthAuthorizer',
        'ad-authorization' => 'KartsNMS\Authentication\ADAuthorizationAuthorizer',
        'ldap-authorization' => 'KartsNMS\Authentication\LdapAuthorizationAuthorizer',
        'sso' => 'KartsNMS\Authentication\SSOAuthorizer',
    ];

    /**
     * Gets the authorizer based on the config
     *
     * @return Authorizer
     */
    public static function get()
    {
        if (! static::$_instance) {
            $class = self::getClass();
            static::$_instance = new $class;
        }

        return static::$_instance;
    }

    /**
     * The auth mechanism type.
     *
     * @return mixed
     */
    public static function getType()
    {
        return Config::get('auth_mechanism');
    }

    /**
     * Get class for the given or current authentication type/mechanism
     *
     * @param  string  $type
     * @return string
     */
    public static function getClass($type = null)
    {
        if (is_null($type)) {
            $type = self::getType();
        }

        if (! isset(self::$configToClassMap[$type])) {
            throw new \RuntimeException($type . ' not found as auth_mechanism');
        }

        return self::$configToClassMap[$type];
    }

    /**
     * Destroy the existing instance and get a new one - required for tests.
     *
     * @return Authorizer
     */
    public static function reset()
    {
        static::$_instance = null;

        return static::get();
    }
}
