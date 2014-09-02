<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-26
 * Time: 上午10:20
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
class CompanyController extends AbstractActionController{

   public function indexAction()
   {
      $db_company = new Model\DbTable\Company();
      $db_image = new Model\DbTable\Image();
      $uploadFilePathPrefix = $db_image->getImageFilePath("company");
      $uploadFileTypeId = $db_image->getImageFileTypeId("company");
      $form = new Form\Company();
      $viewData = array();
      $request = $this->getRequest();
      if ($request->isPost()) {
         $post =array_merge_recursive(
            $request->getPost()->toArray(),
            $request->getFiles()->toArray()
         );
         $form->setData($post);

         if ($form->isValid()) {
            $postData = $form->getData();

            $companyData['CompanyId'] = $postData['CompanyId'];
            $companyData['CompanyInnerId'] = $postData['CompanyInnerId'];
            $companyData = array_merge($companyData, $postData['CompanyBasic']);
            //founded prepare
            $companyData['Founded'] = implode("-", $companyData['Founded']);
            //closed prepare
            $companyData['Closed'] = implode("-", $companyData['Closed']);

            $personImages = $companyData['ProfileImage'];
            unset($companyData['ProfileImage']);

            if(empty($postData['CompanyId']) && empty($postData['CompanyInnerId']))
            {
               //create new record
               $id = $db_company->insert($companyData);
               $objectIdPrefix = $db_company->getObjectIdPrefix();
               $strPadId = str_pad($id, 8, 0, STR_PAD_LEFT);
               $companyData['CompanyId'] = $objectIdPrefix . $strPadId;
               $companyData['CompanyInnerId'] = str_replace("#", "",$objectIdPrefix) . $strPadId;
               $db_company->update(array("CompanyId"=>$companyData['CompanyId'], "CompanyInnerId"=>$companyData['CompanyInnerId']) , "Id=".$id);
            }
            else
            {
               $db_company->update($companyData, "CompanyId='".$companyData['CompanyId']."' AND CompanyInnerId='".$companyData['CompanyInnerId']."'");
            }

            if( !empty($personImages['name']) )
            {
               $fn_file = new DHR\File();
               $fileNames = array();
               $fileNames["CompanyBasic_ProfileImage_"] = $personImages['name'];
               $reFileName = $fn_file->uploadFile($fileNames, $uploadFilePathPrefix);

               $db_image->insert(array(
                  'Type'=>$uploadFileTypeId,
                  'FilePath'=>$reFileName['CompanyBasic_ProfileImage_'],
                  'FileName'=>$personImages['name'],
                  'OutKeyId'=>$companyData['CompanyInnerId']
               ));
            }
           $viewData['insert'] = true;
         }
         else
         {
            $message = $form->getMessages();
            $viewData['insert'] = false;
         }
      }
//      else
//      {
//         $company = $db_company->getCompanyByCompanyId("C#00000003");
//      }

      $viewData = array_merge(
                    $viewData,array('form'=>$form,
                                                'basicInfoKey' =>  array("Founded", "ShortDescription", "Website"),

                                        ));
      $viewModel = new ViewModel($viewData);
    //  $viewModel->setTemplate("application/company/view.phtml");
      return$viewModel;
   }
   public  function deleteAction()
   {
      $view =  new ViewModel();
      return $view;
   }

} 