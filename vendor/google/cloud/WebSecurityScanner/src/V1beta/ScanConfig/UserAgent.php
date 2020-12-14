<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/websecurityscanner/v1beta/scan_config.proto

namespace Google\Cloud\WebSecurityScanner\V1beta\ScanConfig;

use UnexpectedValueException;

/**
 * Type of user agents used for scanning.
 *
 * Protobuf type <code>google.cloud.websecurityscanner.v1beta.ScanConfig.UserAgent</code>
 */
class UserAgent
{
    /**
     * The user agent is unknown. Service will default to CHROME_LINUX.
     *
     * Generated from protobuf enum <code>USER_AGENT_UNSPECIFIED = 0;</code>
     */
    const USER_AGENT_UNSPECIFIED = 0;
    /**
     * Chrome on Linux. This is the service default if unspecified.
     *
     * Generated from protobuf enum <code>CHROME_LINUX = 1;</code>
     */
    const CHROME_LINUX = 1;
    /**
     * Chrome on Android.
     *
     * Generated from protobuf enum <code>CHROME_ANDROID = 2;</code>
     */
    const CHROME_ANDROID = 2;
    /**
     * Safari on IPhone.
     *
     * Generated from protobuf enum <code>SAFARI_IPHONE = 3;</code>
     */
    const SAFARI_IPHONE = 3;

    private static $valueToName = [
        self::USER_AGENT_UNSPECIFIED => 'USER_AGENT_UNSPECIFIED',
        self::CHROME_LINUX => 'CHROME_LINUX',
        self::CHROME_ANDROID => 'CHROME_ANDROID',
        self::SAFARI_IPHONE => 'SAFARI_IPHONE',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(UserAgent::class, \Google\Cloud\WebSecurityScanner\V1beta\ScanConfig_UserAgent::class);
