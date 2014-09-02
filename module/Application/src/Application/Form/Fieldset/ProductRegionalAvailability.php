<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-8-11
 * Time: 上午10:11
 */

namespace Application\Form\Fieldset;

use Zend\Form\Fieldset;
use DHR\String;
use DHR\Form\Element;

class ProductRegionalAvailability extends Fieldset{

    public function __construct()
    {
        parent::__construct("productRegionalAvailability");

        $this->setLabel("REGIONAL AVAILABILITY");

        $dhr_string = new String();
        //Regional Availability
        $this->add(
            array(
                'type'=>"select",
                'name' => 'RegionalAvailability',
                'options' => array(
                    'label' => 'Regional availability',
                    'value_options'=>$dhr_string->getProductRegionalAvailability()
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