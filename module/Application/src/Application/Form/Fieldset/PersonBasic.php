<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-24
 * Time: 下午2:53
 */

namespace Application\Form\Fieldset;

use Zend\Form\Fieldset;
use DHR\Form\Element\DateSelect;
use DHR\String;
use DHR\Form\Element;
use Zend\Mail\Header\Date;

class PersonBasic extends Fieldset{

   public function __construct()
   {
      parent::__construct("personBasic");

      $this->setLabel("Person Overview");

      $dhr_string = new String();
      $this->add(
         array(
            'type'=>"text",
            'name' => 'LinkedinURL',
            'attributes'=>array(
              'value'=>"http://"
            ),
            'options' => array(
               'label' => 'Linkedin Public Profile URL',

            )
         )
      );

      //profile image
      $this->add(array(
         'type'=>"file",
         'name'=>'ProfileImage',
         'options'=>array(
            'label'=>"Profile Image"
         ),
      ));

      //first name
      $this->add(
         array(
            'type'=>"text",
            'name' => 'FirstName',
            'options' => array(
               'label' => 'First Name',

            )
         )
      );

      //last name
      $this->add(
         array(
            'type'=>"text",
            'name' => 'LastName',
            'options' => array(
               'label' => 'Last Name',

            )
         )
      );

      //email
      $this->add(
         array(
            'type'=>"text",
            'name' => 'Email',
            'options' => array(
               'label' => 'Email',

            )
         )
      );

      //mobile
      $this->add(
         array(
            'type'=>"text",
            'name' => 'Mobile',
            'options' => array(
               'label' => 'Mobile',

            )
         )
      );

      //Phone
      $this->add(
         array(
            'type'=>"text",
            'name' => 'Phone',
            'options' => array(
               'label' => 'Phone',

            )
         )
      );

      $element_born = new DateSelect("Born", array("label"=>"Born"));
      $this->add($element_born);

      $element_deceased = new DateSelect("Deceased", array("label"=>"Deceased", "Closed"=>true));
      $this->add($element_deceased);

     //location lookup

      //primary affiliation lookup

      //homepage
      $this->add(
         array(
            'type'=>"text",
            'name' => 'website',
            'attributes'=>array(
               'value'=>"http://"
            ),
            'options' => array(
               'label' => 'Homepage / Websites',
            )
         )
      );

      //experience

      //education


   }

} 