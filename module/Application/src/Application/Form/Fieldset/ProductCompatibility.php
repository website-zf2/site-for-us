<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-8-4
 * Time: 下午3:46
 */

namespace Application\Form\Fieldset;

use Zend\Form\Fieldset;
use DHR\String;
use DHR\Form\Element;
class ProductCompatibility extends  Fieldset{
    public function __construct()
    {
        parent::__construct("productCompatibility");

        $this->setLabel("Product Compatibility");

        //lookup product compatibility
        $element_productCompatibility = new Element\Looksup('productCompatibility', array("controller"=>"product", "label"=>"Product Compatibility"));
        $this->add($element_productCompatibility);
    }
} 