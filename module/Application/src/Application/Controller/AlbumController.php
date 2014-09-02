<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-13
 * Time: 上午9:53
 */

namespace Application\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Validator\AbstractValidator;
use Zend\Session\Container;
use Application\Form;
use Application\Form\InputFilter;
use Application\Model;
use Application\Model\Entity;
class AlbumController extends  AbstractActionController{


   public function indexAction()
   {

      $form = new Form\Company();
//      $company = new Entity\Company();
//      $form->bind($company);

//      $companyInputFilter = new InputFilter\Company();
//      $form->setInputFilter($companyInputFilter->getInputFilter());

      $request = $this->getRequest();
      if ($request->isPost()) {
         $post =array_merge_recursive(
                     $request->getPost()->toArray(),
                      $request->getFiles()->toArray()
         );
         $form->setData($post);

         if ($form->isValid()) {
//            var_dump($form->getData());die;
            $aa = $form->getData();
            $form->populateValues($aa);
            echo "ok valid";
            // Redirect to list of albums
           // return $this->redirect()->toRoute('album');
         }
         else
         {
            $message = $form->getMessages();
            echo "error valid";
         }
      }
      return new ViewModel(array('form'=>$form));
   }
   public  function deleteAction()
   {
      $view =  new ViewModel();
      return $view;
   }
} 