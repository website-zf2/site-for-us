<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-8-4
 * Time: 下午3:43
 */

namespace Application\Form\Fieldset;

use Zend\Form\Fieldset;
use DHR\String;
use DHR\Form\Element;
class ProductConnectivity extends Fieldset{

    public function __construct()
    {
        parent::__construct("productConnectivity");

        $this->setLabel("CONNECTIVITY");

        $dhr_string = new String();
        //connectivity
        $element_connectivity = new Element\MultiCheckbox('Connectivity', array("label"=>"Connectivity", "value_options"=>$dhr_string->getProductConnectivity()));
        $this->add($element_connectivity);
    }
} 