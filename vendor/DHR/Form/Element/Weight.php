<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-8-6
 * Time: 上午10:14
 */

namespace DHR\Form\Element;

use Zend\Form\Element;
use Zend\InputFilter\InputProviderInterface;

class Weight extends Element implements InputProviderInterface{

    protected $validator;
    public function getValidator()
    {
        return $this->validator;
    }

    public function getInputSpecification()
    {
        $spec = array(
            'name' => $this->getName(),
        );

        if ($validator = $this->getValidator()) {
            $spec['validators'] = array(
                $validator,
            );
        }

        return $spec;
    }
} 