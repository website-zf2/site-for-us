<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-16
 * Time: 下午3:36
 */

namespace DHR\Form\View\Helper;

use DHR\Form\Element;
use Zend\Form\View\Helper\FormElement as BaseFormElement;
use Zend\Form\ElementInterface;
class FormElement extends BaseFormElement{

   public function render(ElementInterface $element)
   {
        $renderer = $this->getView();
            if(!method_exists($renderer, 'plugin')){
            return '';
        }

        if($element instanceof Element\Demo)
        {
            $helper = $renderer->plugin('form_demo');
            return $helper($element);
        }
        else if($element instanceof Element\DateSelect)
        {
            $helper = $renderer->plugin('form_dateselect');
            return  '</label></td><td class=\'form-input\'>'.$helper($element)."</td>";
        }
        else if($element instanceof Element\Dimensions)
        {
            $helper = $renderer->plugin("form_dimensions");
            return  '</label></td><td class=\'form-input\'>'.$helper($element)."</td>";
        }
        else if($element instanceof Element\MultiCheckbox)
        {
            $helper = $renderer->plugin("form_multicheckbox");
            return  '</label></td><td class=\'form-input\'>'.$helper($element)."</td>";
        }
        else if($element instanceof Element\Looksup)
        {
            $helper = $renderer->plugin("form_looksup");
            return  '</label></td><td class=\'form-input\'>'.$helper($element)."</td>";
        }
        else if($element instanceof Element\Weight)
        {
            $helper = $renderer->plugin("form_weight");
            return  '</label></td><td class=\'form-input\'>'.$helper($element)."</td>";
        }
        if($element->getAttribute("type") != "hidden" && $element->getAttribute("type") != "submit")
        return '</label></td><td class=\'form-input\'>'.parent::render($element)."</td>";


        //else
        //return parent::render($element).'</li>';
        return parent::render($element);
   }
} 