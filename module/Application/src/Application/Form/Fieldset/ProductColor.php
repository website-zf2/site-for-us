<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-8-11
 * Time: 上午10:00
 */

namespace Application\Form\Fieldset;

use Zend\Form\Fieldset;
use DHR\String;
use DHR\Form\Element;
class ProductColor extends  Fieldset{
    public function __construct()
    {
        parent::__construct("productColor");

        $this->setLabel("COLORS");

        $dhr_string = new String();
        //Regional Availability
        $this->add(
            array(
                'type'=>"select",
                'name' => 'Color',
                'options' => array(
                    'label' => 'Colors',
                    'value_options'=>$dhr_string->getProductColors()
                ),
                'attributes'=>array(
                    'class'=>"single_select",
                    'multiple'=>'multiple',
                    'style'=>"width: 120px"
                )
            )
        );
    }
} 