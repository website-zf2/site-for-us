<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-7-30
 * Time: 上午11:18
 */

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use DHR\String;
class Looksup extends Form{

    public function __construct($name = null)
    {
        parent::__construct('product');
        $this->setAttribute('method', 'post');
        $this->setAttribute("class", "pure-form");

        $this->add(array(
            'name' => 'Keyword',
            'type' => 'text',
            'options'=>array(
                'label'=>"Keyword"
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Go',
                'id' => 'submitbutton',
            ),
        ));
    }
} 