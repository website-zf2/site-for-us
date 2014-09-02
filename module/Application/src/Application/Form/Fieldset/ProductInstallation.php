<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-8-4
 * Time: 下午3:46
 */

namespace Application\Form\Fieldset;

use Zend\Form\Fieldset;
use DHR\String;
use DHR\Form\Element;
class ProductInstallation extends  Fieldset{
    public function __construct()
    {
        parent::__construct("productInstallation");

        $this->setLabel("INSTALLATION GUIDE");

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
    }
} 