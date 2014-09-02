<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-8-14
 * Time: 上午9:48
 */

namespace DHR\View\Helper;

use \Zend\View\Helper\EscapeHtml as BaseEscapeHtml;
class EscapeHtml extends BaseEscapeHtml{
    protected function escape($value)
    {
        return $value;
    }
} 