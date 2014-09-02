<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-8-4
 * Time: 下午3:42
 */

namespace Application\Form\Fieldset;

use Zend\Form\Fieldset;
use DHR\String;
use DHR\Form\Element;
class ProductDimensions extends Fieldset{

    public function __construct()
    {
        parent::__construct("productDimensions");

        $this->setLabel("DIMENSIONS & WEIGHT");

        //dimensions
        $element_dimensions = new Element\Dimensions("Dimensions", array("label"=>"Dimensions"));
        $this->add($element_dimensions);

        //weight
        $element_weight = new Element\Weight("Weight", array("label"=>"Weight"));
        $this->add($element_weight);

//       $this->add(
//           array(
//               'name' => 'Weight',
//               'type'=>"text",
//               'options' => array(
//                   'label' => 'Product Weight',
//               )
//           )
//       );
    }

} 