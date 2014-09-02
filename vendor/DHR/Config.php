<?php
/**
 * Created by PhpStorm.
 * User: RayZheng
 * Date: 8/7/14
 * Time: 3:31 下午
 */

namespace DHR;


class Config
{
    protected static $config = array();

    /**
     * Set serviceManager instance
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return void
     */
    public static function setConfig(\Zend\ServiceManager\ServiceLocatorInterface $sm)
    {
        static::$config = $sm->get('config');
    }

    public static function getConfig()
    {
        return static::$config;
    }

    /**
     * Get all config from merged config php file
     *
     * @return array
     */
    public function getAllConfig()
    {
        return $this->getConfig();
    }

    /**
     * Get specified config via a config path
     * @param null $path the path of config with '.' (without ')
     * @return mix
     */
    public static function getConfigByPath($path = null)
    {
        if (empty($path))
             return static::$config;
        else
        {
            $allConfig = static::$config;
            $pathArray = explode(".", $path);
            foreach ($pathArray as $key)
            {
                $allConfig = $allConfig[$key];
            }
            return $allConfig;
        }
    }
}