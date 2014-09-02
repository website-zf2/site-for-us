<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-8-4
 * Time: 下午4:06
 */

namespace Application\Form\Fieldset;

use Zend\Form\Fieldset;
use DHR\String;
use DHR\Form\Element;
class ProductGeneration extends Fieldset{

    public function __construct()
    {
        parent::__construct("ProductGeneration");

        $this->setLabel("Product Generation");
//        //current product generation
//        $this->add(
//            array(
//                'name' => 'ProductGeneration',
//                'type'=>"text",
//                'options' => array(
//                    'label' => 'Production Generation (current)',
//                )
//            )
//        );

        //product generation log
        $this->add(
            array(
                'name' => 'GenerationLog',
                'type'=>"textarea",
                'options' => array(
                    'label' => 'Product Generation Log',
                )
            )
        );
    }
} 