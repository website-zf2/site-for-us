<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-16
 * Time: 上午10:30
 */
namespace DHR\Form\Validator;
use Zend\Validator\AbstractValidator;

class DemoValidator extends  AbstractValidator{

   const FLOAT="float";
   protected $messageTemplates = array(
      self::FLOAT =>" '%value%' is not a floating point value"
   );

   public function isValid($value)
   {
      $this->setValue($value);
      if(true)
      {
         $this->error(self::FLOAT);
         return false;
      }
      return true;
   }
}