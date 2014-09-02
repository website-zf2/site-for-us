<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-20
 * Time: 下午1:24
 */
namespace DHR\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\AbstractHelper;
class FormDateSelect extends AbstractHelper{

   protected $script =   'DHR/Form/View/Scripts/dateselect.phtml';
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
?>
