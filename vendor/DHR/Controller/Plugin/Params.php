<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-8-21
 * Time: 下午4:25
 */

namespace DHR\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\Params as baseParams;
class Params extends baseParams{

    public function getParams($param = null, $default = null)
    {
        $result = $this->fromPost($param, $default);
        if($result === $default)
            return $this->fromQuery($param, $default);
        else
            return $result;
    }
} 