<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-16
 * Time: 下午2:50
 */

namespace DHR\Form\Element;
use Zend\Form\Element;
use Zend\InputFilter\InputProviderInterface;
class Demo extends  Element implements InputProviderInterface{

   protected $validator;
   public function getValidator()
   {
      return $this->validator;
   }

   public function getInputSpecification()
   {
      return array(
         'name'=>$this->getName(),
         'required'=>true,
      );
   }


} 