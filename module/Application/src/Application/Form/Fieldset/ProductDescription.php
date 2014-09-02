<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-8-4
 * Time: 下午1:58
 */

namespace Application\Form\Fieldset;

use Zend\Form\Fieldset;
use DHR\Form\Element\DateSelect;
use DHR\String;
use DHR\Form\Element;
class ProductDescription extends Fieldset{

    public function __construct()
    {
        parent::__construct("productBasic");

        $this->setLabel("PRODUCT DESCRIPTION");

        $dhr_string = new String();

        //description
        $this->add(
            array(
                'name' => 'Description',
                'type'=>"textarea",
                'attributes'=>array('style'=>"height: 210px"),
                'options' => array(
                    'label' => 'Detailed',
                )
            )
        );
    }
} 