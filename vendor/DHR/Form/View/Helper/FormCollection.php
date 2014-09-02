<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-23
 * Time: 上午11:19
 */

namespace DHR\Form\View\Helper;

use Zend\Form\View\Helper\FormCollection as BaseFormCollection;
use Zend\Form\ElementInterface;
class FormCollection extends BaseFormCollection{

   /**
    * Render a collection by iterating through all fieldsets and elements
    *
    * @param  ElementInterface $element
    * @return string
    */
   public function render(ElementInterface $element)
   {
      $renderer = $this->getView();
      if (!method_exists($renderer, 'plugin')) {
         // Bail early if renderer is not pluggable
         return '';
      }
    $fieldsetName = $element->getAttribute("name");
      $markup           = '';
      $templateMarkup   = '';
      $escapeHtmlHelper = $this->getEscapeHtmlHelper();
      $elementHelper    = $this->getElementHelper();
      $fieldsetHelper   = $this->getFieldsetHelper();
      if ($element instanceof CollectionElement && $element->shouldCreateTemplate()) {
         $templateMarkup = $this->renderTemplate($element);
      }

      foreach ($element->getIterator() as $elementOrFieldset) {
         if ($elementOrFieldset instanceof FieldsetInterface) {
            $markup .= $fieldsetHelper($elementOrFieldset);
         } elseif ($elementOrFieldset instanceof ElementInterface) {
            $markup .= $elementHelper($elementOrFieldset);
         }
      }

      // If $templateMarkup is not empty, use it for simplify adding new element in JavaScript
      if (!empty($templateMarkup)) {
         $markup .= $templateMarkup;
      }
      // Every collection is wrapped by a fieldset if needed
      if ($this->shouldWrap) {
         $label = $element->getLabel();

         if (!empty($label)) {

            if (null !== ($translator = $this->getTranslator())) {
               $label = $translator->translate(
                  $label, $this->getTranslatorTextDomain()
               );
            }

            $label = $escapeHtmlHelper($label);

            $markup = sprintf(
               '<fieldset id="'.$fieldsetName.'"><div class="fieldset-legend"><legend>%s</legend></div><div class="fieldset-content"><table>%s</table></div><div class="fieldset-bottom"></div></fieldset>',
               $label,
               $markup
            );
         }
      }

      return $markup;
   }

} 