<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-8-6
 * Time: 上午10:14
 */

namespace DHR\Form\View\Helper;

use Zend\Form\ElementInterface;
use Zend\Form\View\Helper\AbstractHelper;
class FormWeight extends AbstractHelper {

    protected $script =   'DHR/Form/View/Scripts/weight.phtml';

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