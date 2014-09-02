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
class ProductVideo extends Fieldset{

    public function __construct()
    {
        parent::__construct("ProductVideo");

        $this->setLabel("VIDEOS");
        //product videos
        $this->add(array(
            'type'=>"file",
            'name'=>'ProductVideos',
            'options'=>array(
                'label'=>"Videos"
            ),
        ));

    }
} 