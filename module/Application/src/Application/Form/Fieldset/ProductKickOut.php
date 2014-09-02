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
class ProductKickOut extends Fieldset{

    public function __construct()
    {
        parent::__construct("productKickOut");

        $this->setLabel("KICK-OUT CRITERIA");

        ///Amateurs Purchasable
        $this->add(
            array(
                'name' => 'AmateursPurchasable',
                'type'=>"checkbox",
                'options' => array(
                    'label' => 'Easily purchasable',
                    'label_attributes'=>array('title'=>"Mainstream consumers are easily able to purchase the product, e.g. via a well-known online retailer such as Amazon.com")
                )
            )
        );

        //Amateurs Install
        $this->add(
            array(
                'name' => 'AmateursInstall',
                'type'=>"checkbox",
                'options' => array(
                    'label' => 'Easily installable',
                    'label_attributes'=>array("title"=>"Mainstream consumers are easily able to install and utilize the product without having advanced technical knowledge.")
                )
            )
        );

        //Really Smart
        $this->add(
            array(
                'name' => 'ReallySmart',
                'type'=>"checkbox",
                'options' => array(
                    'label' => 'Really smart',
                    'label_attributes'=>array("title"=>"Mainstream consumers believe the product truly offers valuable smart functionalities older products are not offering.")
                )
            )
        );
    }
} 