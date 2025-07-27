<?php

namespace Config;

use CodeIgniter\Config\BaseService;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    public static function databaseService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('databaseService');
        }

        return new \App\Services\Database\DatabaseService();
    }

    public static function responseService(bool $getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('responseService');
        }

        return new \App\Services\Response\ResponseService();
    }

    public static function jwtService(bool $getShared = true){
        if($getShared){
            return static::getSharedInstance('jwtService');
        }

        return new \App\Services\Jwt\JwtService();
    }

    public static function cookiesService(bool $getShared = true){
        if($getShared){
            return static::getSharedInstance('cookiesService');
        }

        return new \App\Services\Cookies\CookiesService();
    }
}
