<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-16
 * Time: 上午11:10
 */

namespace Application\Form\InputFilter;


use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use DHR\Form\Validator;
class Company implements InputFilterAwareInterface{
   // Add content to these methods:
   protected $inputFilter = null;
   public function setInputFilter(InputFilterInterface $inputFilter)
   {
      throw new \Exception("Not used");
   }

   public function getInputFilter()
   {
      if (!$this->inputFilter) {
         $inputFilter = new InputFilter();
         $factory     = new InputFactory();

         $demoValidator = new Validator\DemoValidator();
         $inputFilter->add($factory->createInput(array(
            'name'     => 'CompanyName',
            'required' => true,
            'filters'  => array(
               array('name' => 'StringTrim'),
            ),
            'validators' => array($demoValidator)
         )));

         $this->inputFilter = $inputFilter;
      }

      return $this->inputFilter;
   }
}