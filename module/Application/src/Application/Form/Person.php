<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-24
 * Time: 下午2:47
 */

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\Mvc\Application;
use DHR\String;
class Person extends Form{
   public function __construct($name = null)
   {
      $dhr_string = new String();
      // we want to ignore the name passed
      parent::__construct('person');
      $this->setAttribute('method', 'post');
      $this->setAttribute('action', "/person/index");
      $this->setAttribute("class", "pure-form");
      $this->add(array(
         'name' => 'PersonId',
         'type' => 'Hidden',
      ));
      $this->add(array(
         'name' => 'PersonInnerId',
         'type' => 'Hidden',
      ));

      //add person basic fieldset
      $this->add(
         array(
            "type"=>"Application\Form\Fieldset\PersonBasic",
            'name'=>"PersonBasic"
         )
      );

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