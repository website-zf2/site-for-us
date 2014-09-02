<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-23
 * Time: 下午4:40
 */

namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\Mvc\Application;
use DHR\String;

class Product extends  Form{
   public function __construct($name = null)
   {
      $dhr_string = new String();

      // we want to ignore the name passed
      parent::__construct('product');
      $this->setAttribute('method', 'post');
//      $this->setAttribute('action', "/product/index");
      $this->setAttribute("class", "pure-form");
       $this->setAttribute("id", "product");

      $this->add(array(
          "name"=>"tempId",
          'attributes'=>array("value"=>uniqid(), "id"=>"tempId"),
          'type'=>"Hidden"
      ));

      $this->add(array(
         'name' => 'ProductId',
         'type' => 'Hidden',
      ));
      $this->add(array(
         'name' => 'ProductInnerId',
         'type' => 'Hidden',
      ));



       //Fieldset: Product Basic
      $this->add(
         array(
            "type"=>"Application\Form\Fieldset\ProductBasic",
            'name'=>"ProductBasic",
         )
      );

       //Fieldset: PRODUCTION GENERATION
//       $this->add(
//           array(
//               "type"=>"Application\Form\Fieldset\ProductGeneration",
//               'name'=>"ProductGeneration",
//           )
//       );
      //Fieldset: Company Description
      $this->add(
           array(
               "type"=>"Application\Form\Fieldset\ProductDescription",
               'name'=>"ProductDescription",
           )
       );



//       //Fieldset: KICK-OUT CRITERIA
//       $this->add(
//           array(
//               "type"=>"Application\Form\Fieldset\ProductKickOut",
//               'name'=>"ProductKickOut",
//
//           )
//       );

       //Fieldset: PRODUCT FEATURE
       $this->add(
           array(
               "type"=>"Application\Form\Fieldset\ProductFeature",
               'name'=>"ProductFeature",

           )
       );



       //Fieldset: CONTROL SOFTWARE OPERATION SYSTEM COMPATIBILITY
//       $this->add(
//           array(
//               "type"=>"Application\Form\Fieldset\ProductSoftware",
//               'name'=>"ProductSoftware",
//
//           )
//       );

       //Fieldset: CONNECTIVITY
//       $this->add(
//           array(
//               "type"=>"Application\Form\Fieldset\ProductConnectivity",
//               'name'=>"ProductConnectivity",
//
//           )
//       );





       //Fieldset: POWER SUPPLY
//       $this->add(
//           array(
//               "type"=>"Application\Form\Fieldset\ProductPowerSupply",
//               'name'=>"ProductPowerSupply",
//
//           )
//       );

       //Fieldset: DIMENSIONS
//       $this->add(
//           array(
//               "type"=>"Application\Form\Fieldset\ProductDimensions",
//               'name'=>"ProductDimensions",
//           )
//       );


       //#Fieldset: COLOR
//       $this->add(
//           array(
//               "type"=>"Application\Form\Fieldset\ProductColor",
//               'name'=>"productColor",
//
//           )
//       );

       //Fieldset: PRODUCT PHOTOS
       $this->add(
           array(
               "type"=>"Application\Form\Fieldset\ProductPhoto",
               'name'=>"ProductPhoto",

           )
       );
       //Fieldset: PRODUCT VIDEOS
       $this->add(
           array(
               "type"=>"Application\Form\Fieldset\ProductVideo",
               'name'=>"ProductVideo",

           )
       );

       //Fieldset: Software screenshots
       $this->add(
           array(
               "type"=>"Application\Form\Fieldset\ProductSoftwareScreenShots",
               'name'=>"ProductSoftwareScreenShots",

           )
       );

       //Fieldset: What's in the box
//       $this->add(
//           array(
//               "type"=>"Application\Form\Fieldset\ProductBoxContent",
//               'name'=>"ProductBoxContent",
//           )
//       );


       //Fieldset: PRODUCT INSTALLATION
//       $this->add(
//           array(
//               "type"=>"Application\Form\Fieldset\ProductInstallation",
//               'name'=>"ProductInstallation",
//           )
//       );

       //Fieldset: PRODUCT API
//       $this->add(
//           array(
//               "type"=>"Application\Form\Fieldset\ProductAPI",
//               'name'=>"ProductAPI",
//
//           )
//       );

    //Fieldset: Regional availability
       $this->add(
           array(
               "type"=>"Application\Form\Fieldset\ProductRegionalAvailability",
               'name'=>"productRegionalAvailability",

           )
       );


       //Fieldset: PRODUCT COMPATIBILITY
//       $this->add(
//           array(
//               "type"=>"Application\Form\Fieldset\ProductCompatibility",
//               'name'=>"ProductCompatibility",
//
//           )
//       );

//      $this->add(array(
//         'name' => 'submit',
//         'type' => 'Submit',
//         'attributes' => array(
//            'value' => 'Submit',
//            'id' => 'submitbutton',
//         ),
//      ));


//     $this->add(array(
//         'name' => 'back',
//         'type' => 'button',
//
//        'options'=>array(
//            'label'=>'go back'
//        )
//      ));
      //set form input filter
       $inputFilter = new InputFilter\Product();
      $this->setInputFilter($inputFilter->getInputFilter());

   }
} 