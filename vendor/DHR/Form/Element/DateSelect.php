<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-20
 * Time: 下午1:18
 */

namespace DHR\Form\Element;
use Zend\Form\Element;
use Zend\InputFilter\InputProviderInterface;

class DateSelect extends Element implements InputProviderInterface{

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

   public function setValue($value)
   {

      $this->value = $value;
   }
} 