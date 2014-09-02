<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-7-30
 * Time: 上午9:20
 */

namespace DHR\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\AbstractHelper;
class FormLooksup extends  AbstractHelper{
    protected $script =   'DHR/Form/View/Scripts/looksup.phtml';

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