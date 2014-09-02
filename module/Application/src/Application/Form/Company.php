<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-16
 * Time: 上午10:42
 */

namespace Application\Form;


use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\Mvc\Application;
use DHR\String;

class Company extends Form
{
   public function __construct($name = null)
   {
      $dhr_string = new String();
      // we want to ignore the name passed
      parent::__construct('company');
      $this->setAttribute('method', 'post');
      $this->setAttribute('action', "/company/index");
      $this->setAttribute("class", "pure-form");
      $this->add(array(
         'name' => 'CompanyId',
         'type' => 'Hidden',
      ));
      $this->add(array(
         'name' => 'CompanyInnerId',
         'type' => 'Hidden',
      ));



      //add company basic fieldset
      $this->add(
         array(
            "type"=>"Application\Form\Fieldset\CompanyBasic",
            'name'=>"CompanyBasic"
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