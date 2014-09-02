<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-24
 * Time: 上午9:24
 */

namespace DHR\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\AbstractHelper;
class FormDimensions extends AbstractHelper {

   protected $script =   'DHR/Form/View/Scripts/dimensions.phtml';

   public function render(ElementInterface $element)
   {
      return $this->getView()->render($this->script, array('element'=>$element));
   }

   public function __invoke(ElementInterface $element = null)
   {
      if (!$element) {
         return $this;
      }
      return $this->render($element);
   }
} 