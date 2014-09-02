<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-19
 * Time: 下午3:18
 */
namespace Application\Form\Fieldset;

use Zend\Form\Fieldset;
use DHR\Form\Element\DateSelect;
use DHR\String;
class CompanyBasic extends Fieldset
{
   public function __construct()
   {
      parent::__construct("companyBasic");

      $this->setLabel("Company Overview");

      $dhr_string = new String();
      $this->add(
         array(
            'type'=>"select",
            'name' => 'Ecosystem',
            'options' => array(
               'label' => 'Ecosystem',
               'value_options'=>$dhr_string->getEcosystem()
            ),
            'attributes'=>array(
               'class'=>"single_select"
            )
         )
      );

      $this->add(array(
         'type'=>"file",
         'name'=>'ProfileImage',
         'options'=>array(
            'label'=>"Profile Image"
         ),
      ));


      $this->add(
         array(
            'name' => 'CompanyName',
            'options' => array(
               'label' => 'Name',
            )
         )
      );

     $founded = new DateSelect("Founded", array("label"=>"Founded"));
     $this->add($founded);

     $closed = new DateSelect("Closed", array("label"=>"Closed", "Closed"=>true));
     $this->add($closed);

      //stock exchange
      $this->add(
         array(
            'name' => 'StockExchange',
            'options' => array(
               'label' => 'Stock Exchange',
            )
         )
      );

      //stock symbol
      $this->add(
         array(
            'name' => 'StockSymbol',
            'options' => array(
               'label' => 'Stock Symbol',
            )
         )
      );

      //stock description
      $this->add(
         array(
            'name' => 'ShortDescription',
            'type'=>"textarea",
//            'attributes'=>array("style"=>"height: 80px"),
            'options' => array(
               'label' => 'Short Description',

            )
         )
      );

      //website
      $this->add(
         array(
            'name' => 'Website',
            'type'=>"text",
            'attributes'=>array("value"=>"http://"),
            'options' => array(
               'label' => 'Homepage / Websites',



            )
         )
      );

      //description
      $this->add(
         array(
            'name' => 'Description',
            'type'=>"textarea",
            'attributes'=>array("style"=>"height: 80px"),
            'options' => array(
               'label' => 'Description / Detailed Description',

            )
         )
      );
   }
}
?>
