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
class ProductPhoto extends Fieldset{

    public function __construct()
    {
        parent::__construct("ProductPhoto");

        $this->setLabel("PHOTOS");

        ///product photos
        $this->add(array(
            'type'=>"file",
            'name'=>'ProductPhotos',
            'options'=>array(
                'label'=>"Photos"
            ),
        ));
    }
} 