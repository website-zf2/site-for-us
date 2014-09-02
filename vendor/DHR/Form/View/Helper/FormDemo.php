<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-16
 * Time: 下午2:36
 */

namespace DHR\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\AbstractHelper;
class FormDemo extends AbstractHelper{

   protected $script =   'DHR/Form/View/Scripts/demo.phtml';
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