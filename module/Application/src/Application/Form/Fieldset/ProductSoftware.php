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
class ProductSoftware extends Fieldset{

    public function __construct()
    {
        parent::__construct("ProductSoftware");

        $this->setLabel("SOFTWARE");

        $dhr_string = new String();



        //product control software operating system  compatibility
        $element_OSCompatibility = new Element\MultiCheckbox('OSCompatibility', array("label"=>"Software", "value_options"=>$dhr_string->getOSCompatibility()));
        $this->add($element_OSCompatibility);

        //Product API
        $this->add(
            array(
                'name' => 'API',
                'type'=>"checkbox",
                'options' => array(
                    'label' => 'API',
                )
            )
        );

        //Product API Name
        $this->add(
            array(
                'name' => 'APIName',
                'type'=>"text",
                'options' => array(
                    'label' => 'API name',
                )
            )
        );

        //Product API Website
        $this->add(
            array(
                'name' => 'APIWebsite',
                'type'=>"text",
                'options' => array(
                    'label' => 'API website',
                )
            )
        );

        //control Software screentshots
//        $this->add(array(
//            'type'=>"file",
//            'name'=>'ProductSoftwareScreenShots',
//            'options'=>array(
//                'label'=>"Product Control Software Screenshots"
//            ),
//        ));
    }
} 