<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-8-11
 * Time: 上午10:02
 */

namespace Application\Form\Fieldset;

use Zend\Form\Fieldset;
use DHR\String;
use DHR\Form\Element;
class ProductBoxContent extends Fieldset{

    public function __construct()
    {
        parent::__construct("productContentBox");

        $this->setLabel("WHAT'S IN THE BOX");


        //box content
        $this->add(array(
            'type'=>"textarea",
            'name'=>'BoxContent',
            'options'=>array(
                "label"=>"Box content"
            )
        ));

    }
} 