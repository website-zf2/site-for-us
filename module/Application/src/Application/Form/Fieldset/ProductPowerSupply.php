<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-8-4
 * Time: 下午3:44
 */

namespace Application\Form\Fieldset;

use Zend\Form\Fieldset;
use DHR\String;
use DHR\Form\Element;
class ProductPowerSupply extends  Fieldset{
    public function __construct()
    {
        parent::__construct("Product Power Supply");

        $this->setLabel("POWER SUPPLY");

        $dhr_string = new String();
        //power supply
//        $element_PowerSupply = new Element\MultiCheckbox('PowerSupply', array("label"=>"Power Supply", "value_options"=>$dhr_string->getProductPowerSupply()));
//        $this->add($element_PowerSupply);

        $this->add(
            array(
                'type'=>"select",
                'name' => 'PowerSupply',
                'options' => array(
                    'label' => 'Power supply',
                    'value_options'=>$dhr_string->getProductPowerSupply()
                ),
                'attributes'=>array(
                    'class'=>"single_select",
                    'multiple'=>'multiple',
                )
            )
        );

        //battery life time
        $this->add(
            array(
                'name' => 'BatteryLifeTime',
                'type'=>"text",
                'options' => array(
                    'label' => 'Battery life time',
                )
            )
        );

        //Power Cable Length
        $this->add(
            array(
                'name' => 'PowerCableLength',
                'type'=>"text",
                'options' => array(
                    'label' => 'Power cable length',
                )
            )
        );
    }
}