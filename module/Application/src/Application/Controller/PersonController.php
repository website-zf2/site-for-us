<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-24
 * Time: 下午2:46
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Validator\AbstractValidator;
use Zend\Session\Container;
use Application\Form;
use Application\Form\InputFilter;
use Application\Model;
use DHR;
class PersonController extends AbstractActionController{
   public function indexAction()
   {

      $db_person = new Model\DbTable\Person();
      $db_image = new Model\DbTable\Image();
      $uploadFilePathPrefix = $db_image->getImageFilePath("person");
      $uploadFileTypeId = $db_image->getImageFileTypeId("person");
      $form = new Form\Person();

      $request = $this->getRequest();
      if ($request->isPost())
      {
         $post =array_merge_recursive(
            $request->getPost()->toArray(),
            $request->getFiles()->toArray()
         );
         $form->setData($post);

         if ($form->isValid())
         {
            $postData = $form->getData();
            $personData['PersonId'] = $postData['PersonId'];
            $personData['PersonInnerId'] = $postData['PersonInnerId'];
            $personData = array_merge($personData, $postData['PersonBasic']);
            $personData['Born'] = implode("-", $personData['Born']);
            $personData['Deceased'] = implode("-", $personData['Deceased']);
            $personImages = $personData['ProfileImage'];
            unset($personData['ProfileImage']);

            if(empty($postData['PersonId']) && empty($postData['PersonInnerId']))
            {
               //create new record
               $id = $db_person->insert($personData);
               $objectIdPrefix = $db_person->getObjectIdPrefix();
               $strPadId = str_pad($id, 8, 0, STR_PAD_LEFT);
               $personData['PersonId'] = $objectIdPrefix . $strPadId;
               $personData['PersonInnerId'] = str_replace("#", "",$objectIdPrefix) . $strPadId;
               $db_person->update(array("PersonId"=>$personData['PersonId'], "PersonInnerId"=>$personData['PersonInnerId']) , "Id=".$id);
            }
            else
            {
               $db_person->update($personData, "PersonId='".$personData['PersonId']."' AND PersonInnerId='".$personData['PersonInnerId']."'");
            }

            if( !empty($personImages['name']) )
            {
               $fn_file = new DHR\File();
               $fileNames = array();
               $fileNames["PersonBasic_ProfileImage_"] = $personImages['name'];
               $reFileName = $fn_file->uploadFile($fileNames, $uploadFilePathPrefix);

               $db_image->insert(array(
                  'Type'=>$uploadFileTypeId,
                  'FilePath'=>$reFileName['PersonBasic_ProfileImage_'],
                  'FileName'=>$personImages['name'],
                  'OutKeyId'=>$personData['PersonInnerId']
               ));
            }
            echo "ok valid";
         }
         else
         {
            $message = $form->getMessages();
            echo "error valid";
         }
      }
      return new ViewModel(array("form"=>$form));
   }
} 