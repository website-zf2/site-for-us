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
class ProductFeature extends Fieldset{
    public function __construct()
    {
        parent::__construct("ProductFeature");

        $this->setLabel("SPECIFICATIONS");

        $dhr_string = new String();

        //product control software operating system  compatibility
//        $element_OSCompatibility = new Element\MultiCheckbox('OSCompatibility', array("label"=>"Software", "value_options"=>$dhr_string->getOSCompatibility(), "class"=>""));
//        $this->add($element_OSCompatibility);

        $this->add(
            array(
                'type'=>"select",
                'name' => 'OSCompatibility',
                'options' => array(
                    'label' => 'Software',
                    'value_options'=>$dhr_string->getOSCompatibility()
                ),
                'attributes'=>array(
                    'class'=>"single_select not-show-list",
                    'multiple'=>'multiple',
                )
            )
        );

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



        //connectivity
//        $element_connectivity = new Element\MultiCheckbox('Connectivity', array("label"=>"Connectivity", "value_options"=>$dhr_string->getProductConnectivity()));
//        $this->add($element_connectivity);

        $this->add(
            array(
                'type'=>"select",
                'name' => 'Connectivity',
                'options' => array(
                    'label' => 'Connectivity',
                    'value_options'=>$dhr_string->getProductConnectivity()
                ),
                'attributes'=>array(
                    'class'=>"single_select not-show-list",
                    'multiple'=>'multiple',
                )
            )
        );


        //No Dependency on Other Smart Home Hardware
        $this->add(
            array(
                'name' => 'NoDependencyHardWare',
                'type'=>"checkbox",
                'options' => array(
                    'label' => 'No other hardware dependency',
                    'label_attributes'=>array('title'=>"Certain smart home products can only be used in combination with other hardware.")
                )
            )
        );

        //lookup product compatibility
        $element_productCompatibility = new Element\Looksup('productCompatibility', array("controller"=>"product", "label"=>"Compatible<br/>required hardware"));
        $element_productCompatibility->setLabelAttributes(array("title"=>"Hardware which is required to make a smart home product functional."));
        $this->add($element_productCompatibility);


        ///Amateurs Purchasable
//        $this->add(
//            array(
//                'name' => 'AmateursPurchasable',
//                'type'=>"checkbox",
//                'options' => array(
//                    'label' => 'Easily purchasable',
//                    'label_attributes'=>array('title'=>"Mainstream consumers are easily able to purchase the product, e.g. via a well-known online retailer such as Amazon.com")
//                )
//            )
//        );

        //Amateurs Install
//        $this->add(
//            array(
//                'name' => 'AmateursInstall',
//                'type'=>"checkbox",
//                'options' => array(
//                    'label' => 'Easily installable',
//                    'label_attributes'=>array("title"=>"Mainstream consumers are easily able to install and utilize the product without having advanced technical knowledge.")
//                )
//            )
//        );

        //Really Smart
//        $this->add(
//            array(
//                'name' => 'ReallySmart',
//                'type'=>"checkbox",
//                'options' => array(
//                    'label' => 'Really smart',
//                    'label_attributes'=>array("title"=>"Mainstream consumers believe the product truly offers valuable smart functionalities older products are not offering.")
//                )
//            )
//        );


        //No Monthly Service Fee
        $this->add(
            array(
                'name' => 'MonthlyServiceFee',
                'type'=>"checkbox",
                'options' => array(
                    'label' => 'No monthly<br/>service fee',
                    'label_attributes'=>array('title'=>"Certain smart home product providers require a monthly service fee for access to smart home features.")
                )
            )
        );

        //External Cloud Focused
        $this->add(
            array(
                'name' => 'CloudFocused',
                'type'=>"checkbox",
                'options' => array(
                    'label' => 'External cloud<br/>/ server',
                    'label_attributes'=>array("title"=>"Whether a smart home product is sending data to an external server, usually managed by the product provider.")
                )
            )
        );

        //Remote Access
        $this->add(
            array(
                'name' => 'RemoteAccess',
                'type'=>"checkbox",
                'options' => array(
                    'label' => 'Remote access',
                    'label_attributes'=>array("title"=>"Whether you are able to control the smart home product even when you are not home.")

                )
            )
        );

        //Programmable
        $this->add(
            array(
                'name' => 'Programmable',
                'type'=>"checkbox",
                'options' => array(
                    'label' => 'IFTTT',
                )
            )
        );

        //Energy Efficient
        $this->add(
            array(
                'name' => 'EnergyEfficient',
                'type'=>"checkbox",
                'options' => array(
                    'label' => 'Saves energy',
                )
            )
        );




        //improve health
        $this->add(
            array(
                'name' => 'ImproveHealth',
                'type'=>"checkbox",
                'options' => array(
                    'label' => 'Improves health',
                )
            )
        );

        //improve safety
        $this->add(
            array(
                'name' => 'ImproveSafety',
                'type'=>"checkbox",
                'options' => array(
                    'label' => 'Improves safety',
                )
            )
        );

        $this->add(
            array(
                'type'=>"select",
                'name' => 'PowerSupply',
                'options' => array(
                    'label' => 'Power supply',
                    'value_options'=>$dhr_string->getProductPowerSupply()
                ),
                'attributes'=>array(
                    'class'=>"single_select not-show-list",
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

        //dimensions
        $element_dimensions = new Element\Dimensions("Dimensions", array("label"=>"Dimensions"));
        $this->add($element_dimensions);

        //weight
        $element_weight = new Element\Weight("Weight", array("label"=>"Weight"));
        $this->add($element_weight);


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


        //box content
        $this->add(array(
            'type'=>"textarea",
            'name'=>'BoxContent',
            'options'=>array(
                "label"=>"Box content"
            )
        ));

        //product installation guides
        $this->add(array(
            'type'=>"text",
            'name'=>'ProductInstallationGuide',
            'options'=>array(
                'label'=>"Installation guide"
            ),
            'attributes'=>array(
                'placeholder'=>"[URL]"
            )
        ));

        //Autonomous
//        $this->add(
//            array(
//                'name' => 'Autonomous',
//                'type'=>"checkbox",
//                'options' => array(
//                    'label' => 'Autonomous',
//                    'label_attributes'=>array("title"=>"Requires no human action to benefit from its functionality, a good example would be robot vacuum cleaners.")
//                )
//            )
//        );


        //Voice Control
//        $this->add(
//            array(
//                'name' => 'VoiceControl',
//                'type'=>"checkbox",
//                'options' => array(
//                    'label' => 'Voice control',
//                    'label_attributes'=>array("title"=>"Whether you are able to control the smart home product via your voice.")
//                )
//            )
//        );







    }

} 