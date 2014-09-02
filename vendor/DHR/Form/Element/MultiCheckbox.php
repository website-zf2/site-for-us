<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-24
 * Time: 上午11:31
 */

namespace DHR\Form\Element;

use Zend\Form\Element;
use Zend\InputFilter\InputProviderInterface;
class MultiCheckbox extends Element implements InputProviderInterface{
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