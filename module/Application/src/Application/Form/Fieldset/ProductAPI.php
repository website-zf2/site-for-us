<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-8-4
 * Time: 下午3:45
 */

namespace Application\Form\Fieldset;

use Zend\Form\Fieldset;
use DHR\String;
use DHR\Form\Element;
class ProductAPI extends Fieldset{
    public function __construct()
    {
        parent::__construct("ProductAPI");

        $this->setLabel("API");

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
    }

} 