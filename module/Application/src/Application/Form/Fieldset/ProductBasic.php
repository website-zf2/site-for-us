<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-23
 * Time: 下午4:22
 */

namespace Application\Form\Fieldset;

use Zend\Form\Fieldset;
use DHR\Form\Element\DateSelect;
use DHR\String;
use DHR\Form\Element;
class ProductBasic extends Fieldset{
   public function __construct()
   {
      parent::__construct("productBasic");

      $this->setLabel("Product Overview");

      $dhr_string = new String();

       //profile image
       $this->add(array(
           'type'=>"file",
           'name'=>'ProductImage',
           'options'=>array(
               'label'=>"Product Page Image"
           ),
       ));

       //EcoSystem
      $this->add(
         array(
            'type'=>"select",
            'name' => 'Ecosystem',
            'options' => array(
               'label' => 'Product Ecosystem Focus',
               'value_options'=>$dhr_string->getEcosystem()
            ),
            'attributes'=>array(
               'class'=>"single_select"
            )
         )
      );

      //product name
      $this->add(
         array(
            'name' => 'ProductName',
             'attributes'=>array(
                 'placeholder'=>"Product name",
                 'style'=>"font-size:16px"
             ),
            'options' => array(

            )
         )
      );


      //Launched
      $launched = new DateSelect("Launched", array("label"=>"Launch <span style='font-size: 11px;'>(1st gen)</span>", "escape"=>false));
      $launched->setLabelAttributes(array("title"=>"The official date the product's first generation was launched to the public."));
      $this->add($launched);

       //current product generation
//       $this->add(
//           array(
//               'name' => 'ProductGeneration',
//               'type'=>"text",
//               'options' => array(
//                   'label' => 'Current generation',
//               )
//           )
//       );

      //product Status
      $this->add(
         array(
            'type'=>"select",
            'name' => 'Status',
             'required'=>true,
             'allow_empty'=>true,
            'options' => array(
               'label' => 'Status',
               'value_options'=>$dhr_string->getProductStatus(),
                'allow_empty'=>true
            ),
            'attributes'=>array(
               'class'=>"single_select not-show-list",
                "value"=>"5"

            )
         )
      );

//      //current product generation
//       //website
//       $this->add(
//           array(
//               'name' => 'ProductGeneration',
//               'type'=>"text",
//               'options' => array(
//                   'label' => 'Current Production Generation',
//               )
//           )
//       );
//
//       //product generation log
//       $this->add(
//           array(
//               'name' => 'GenerationLog',
//               'type'=>"textarea",
//               'options' => array(
//                   'label' => 'Product Generation Log',
//               )
//           )
//       );

      //look up owner
      //waiting ...


       //production category
       $this->add(
           array(
               'type'=>"select",
               'name' => 'ProductCategory',
               'options' => array(
                   'label' => "Category",
                   'value_options'=>$dhr_string->getProductCategory(),
                   'label_attributes'=>array('title'=>"The smart home product category the product belongs to.")

               ),
               'attributes'=>array(
                   'class'=>"single_select not-show-list",
                   'multiple'=>'multiple',
//                   'style'=>"width: 250px"
               )
           )
       );

      //product description (short)
//      $this->add(
//         array(
//            'name' => 'ShortDescription',
//            'type'=>"textarea",
//            'options' => array(
//               'label' => 'Description (short)',
//            ),
//             'attributes'=>array(
//                 "style"=>"width: 300px"
//             )
//         )
//      );

      //website
      $this->add(
         array(
            'name' => 'Website',
            'type'=>"text",
            'attributes'=>array("value"=>"http://"),
            'options' => array(
               'label' => 'Website',
            )
         )
      );



//       //Amateurs Purchasable
//       $this->add(
//           array(
//               'name' => 'AmateursPurchasable',
//               'type'=>"checkbox",
//               'options' => array(
//                   'label' => 'Purchasable by AMATEURS [KICK-OUT CRITERIA 1]',
//               )
//           )
//       );
//
//       //Amateurs Install
//       $this->add(
//           array(
//               'name' => 'AmateursInstall',
//               'type'=>"checkbox",
//               'options' => array(
//                   'label' => 'Easy Hardware Installation for AMATEURS [KICK-OUT CRITERIA 2]',
//               )
//           )
//       );

//       //Product API
//       $this->add(
//           array(
//               'name' => 'API',
//               'type'=>"checkbox",
//               'options' => array(
//                   'label' => 'Product API',
//               )
//           )
//       );
//
//       //Product API Name
//       $this->add(
//           array(
//               'name' => 'APIName',
//               'type'=>"text",
//               'options' => array(
//                   'label' => 'Product API Name',
//               )
//           )
//       );
//
//       //Product API Website
//       $this->add(
//           array(
//               'name' => 'APIWebsite',
//               'type'=>"text",
//               'options' => array(
//                   'label' => 'Product API Website',
//               )
//           )
//       );


//       //Energy Efficient
//       $this->add(
//           array(
//               'name' => 'EnergyEfficient',
//               'type'=>"checkbox",
//               'options' => array(
//                   'label' => 'Product Feature: Energy Efficient / Saves Energy (STRONG VALUE PROPOSITION)',
//               )
//           )
//       );
//
//       //Remote Access
//       $this->add(
//           array(
//               'name' => 'RemoteAccess',
//               'type'=>"checkbox",
//               'options' => array(
//                   'label' => 'Product Feature: Remote Access (STRONG VALUE PROPOSITION) [KICK-OUT CRITERIA 3]',
//               )
//           )
//       );
//
//       //Programmable
//       $this->add(
//           array(
//               'name' => 'Programmable',
//               'type'=>"checkbox",
//               'options' => array(
//                   'label' => 'Product Feature: Programmable (STRONG VALUE PROPOSITION)',
//               )
//           )
//       );
//
//       //Randomized Program
//       $this->add(
//           array(
//               'name' => 'RandomizedProgram',
//               'type'=>"checkbox",
//               'options' => array(
//                   'label' => 'Product Feature: Randomized Programs',
//               )
//           )
//       );
//
//       //improve health
//       $this->add(
//           array(
//               'name' => 'ImproveHealth',
//               'type'=>"checkbox",
//               'options' => array(
//                   'label' => 'Product Feature: Improves Health (STRONG VALUE PROPOSITION)',
//               )
//           )
//       );
//
//       //improve safety
//       $this->add(
//           array(
//               'name' => 'ImproveSafety',
//               'type'=>"checkbox",
//               'options' => array(
//                   'label' => 'Product Feature: Improves Safety (STRONG VALUE PROPOSITION)',
//               )
//           )
//       );
//
//       //Voice Control
//       $this->add(
//           array(
//               'name' => 'VoiceControl',
//               'type'=>"checkbox",
//               'options' => array(
//                   'label' => 'Product Feature: Voice Control',
//               )
//           )
//       );




//      //description
//      $this->add(
//         array(
//            'name' => 'Description',
//            'type'=>"textarea",
//            'attributes'=>array('style'=>"height: 210px"),
//            'options' => array(
//               'label' => 'Product Description (detailed)',
//            )
//         )
//      );

      //dimensions
//      $element_dimensions = new Element\Dimensions("Dimensions", array("label"=>"Dimensions"));
//      $this->add($element_dimensions);

//       //weight
//       $this->add(
//           array(
//               'name' => 'Weight',
//               'type'=>"text",
//               'options' => array(
//                   'label' => 'Product Weight',
//               )
//           )
//       );

       //noise level
//       $this->add(
//           array(
//               'name' => 'NoisyLevel',
//               'type'=>"text",
//               'options' => array(
//                   'label' => 'Product Noise Level',
//               )
//           )
//       );

//      //connectivity
//      $element_connectivity = new Element\MultiCheckbox('Connectivity', array("label"=>"Connectivity", "value_options"=>$dhr_string->getProductConnectivity()));
//      $this->add($element_connectivity);
//
//      //product control software operating system  compatibility
//       $element_OSCompatibility = new Element\MultiCheckbox('OSCompatibility', array("label"=>"Product Control Software Operating System Compatibility", "value_options"=>$dhr_string->getOSCompatibility()));
//       $this->add($element_OSCompatibility);
//
//       //control Software screentshots
//       $this->add(array(
//           'type'=>"file",
//           'name'=>'ProductSoftwareScreenShots',
//           'options'=>array(
//               'label'=>"Product Control Software Screenshots"
//           ),
//       ));

//        //power supply
//       $element_PowerSupply = new Element\MultiCheckbox('PowerSupply', array("label"=>"Power Supply", "value_options"=>$dhr_string->getProductPowerSupply()));
//       $this->add($element_PowerSupply);
//
//       //battery life time
//       $this->add(
//           array(
//               'name' => 'BatteryLifeTime',
//               'type'=>"text",
//               'options' => array(
//                   'label' => 'Product Battery Life Time Full Charge',
//               )
//           )
//       );

      //Product Color
//      $this->add(array(
//         'type'=>"text",
//         'name'=>"Color",
//         "options"=>array(
//            'label'=>"Color"
//         )
//      ));

     //Product Regional Availability
//       $this->add(
//           array(
//               'type'=>"select",
//               'name' => 'RegionalAvailability',
//               'options' => array(
//                   'label' => 'Product Regional Availability',
//                   'value_options'=>$dhr_string->getProductRegionalAvailability()
//               ),
//               'attributes'=>array(
//                   'class'=>"single_select"
//               )
//           )
//       );

//       //product photos
//       $this->add(array(
//           'type'=>"file",
//           'name'=>'ProductPhotos',
//           'options'=>array(
//               'label'=>"Product Photos"
//           ),
//       ));
//
//       //product videos
//       $this->add(array(
//           'type'=>"file",
//           'name'=>'ProductVideos',
//           'options'=>array(
//               'label'=>"Product Videos"
//           ),
//       ));
//
//       //product installation guides
//       $this->add(array(
//           'type'=>"file",
//           'name'=>'ProductInstallationGuide',
//           'options'=>array(
//               'label'=>"Product Installation Guides"
//           ),
//       ));
//
//       //lookup product compatibility
//       $element_productCompatibility = new Element\Looksup('productCompatibility', array("controller"=>"product", "label"=>"Product Compatibility"));
//       $this->add($element_productCompatibility);

   }
} 