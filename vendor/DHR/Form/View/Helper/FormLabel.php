<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-17
 * Time: 下午2:07
 */

namespace DHR\Form\View\Helper;

use Zend\Form\View\Helper\FormLabel as BaseFormLabel;

class FormLabel extends  BaseFormLabel{

   public function openTag($attributesOrElement = null)
   {
      return '<tr class=\'form-element\'><td class=\'form-label\'>' . parent::openTag($attributesOrElement);
   }

   public function closeTag()
   {
      return '</tr>';
   }


} 