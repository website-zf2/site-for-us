<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-8-21
 * Time: 下午2:23
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Validator\AbstractValidator;
use Application\Model;
use Application\Model\DbTable;
use DHR;
use Zend\View\View;
class PhotoController extends AbstractActionController{

    public function indexAction(){
        $this->layout('layout/empty.phtml');
        $viewModel = new ViewModel();
        $viewData = array();
        $fileTable = new DbTable\Image();
        $dhrImage = new DHR\DHRImage();

        $viewData['type'] = $imageType = $this->params()->getParams('type');
        $viewData['outKeyId'] = $outKeyId = $this->params()->getParams("outKeyId");
        $viewData['width'] = $targ_w  = $this->params()->getParams("width");
        $viewData['height'] = $targ_h = $this->params()->getParams("height");
        $fileUploadPath = $fileTable->getImageFilePath($imageType);
        $object = $fileTable->getImageFileTypeId($imageType);

        if ($this->getRequest()->isPost()) {

            $jpeg_quality = 90;
            $fileName = $this->params()->getParams("fileName");
            $fileSize = $this->params()->getParams("size");
            $fileType = $this->params()->getParams("fileType");
            $fileName = urldecode($fileName);
            $src = PUBLIC_PATH.$fileUploadPath. '/' . $fileName;


            $extName = strtolower(substr(strrchr($fileName, "."), 1));
            if($extName == "jpg")
            {
                $img_r = imagecreatefromjpeg($src);
            }
            else
            {
                if (strtolower($extName) == "png") {
                    $img_r = imagecreatefrompng($src);
                }
                else if (strtolower($extName) == "bmp") {
                    $img_r = $this->ImageCreateFromBMP($src);
                }
                else if (strtolower($extName) == "gif") {
                    $img_r = imagecreatefromgif($src);
                }

                $extName = "jpg";
            }

            $dst_r = imagecreatetruecolor($targ_w, $targ_h);
            $white = imagecolorallocate($dst_r, 255,255,255);
            imagefilledrectangle($dst_r, 0, 0, $targ_w, $targ_h, $white);
            imagecopyresampled($dst_r, $img_r, 0, 0, $_POST['x'], $_POST['y'], $targ_w, $targ_h, $_POST['w'], $_POST['h']);

            $fileReName = $outKeyId . time() . "." . $extName;
            $photoPath = PUBLIC_PATH . $fileUploadPath . "/" . $fileReName;

            imagejpeg($dst_r, $photoPath, $jpeg_quality);

            $data = array(
                'Size'=>$fileSize,
                'Type' => $fileType,
                'Object'=>$object,
                'OutKeyId' => $outKeyId,
                'FileName' => $fileName,
                'FilePath' => $fileUploadPath . "/" . $fileReName);

            $fileTable->insert($data);

            $viewData['failedValidation'] = "true";
            $photoInformation = $fileTable->getImages($object, $outKeyId);
            if ($photoInformation)
                $viewData['photoInformation'] = $photoInformation;
          //  return $this->redirect()->toUrl($_SERVER['HTTP_REFERER']);
        }
        else
        {
            $viewData['outKeyId'] = $outKeyId = $this->params()->fromQuery('outKeyId');
            $viewData['width'] = $width = $this->params()->fromQuery("width");
            $viewData['height'] = $height = $this->params()->fromQuery('height');
            $viewData['type'] = $type = $this->params()->fromQuery('type');
            $photoInformation = $fileTable->getImages($object, $outKeyId);
            if ($photoInformation)
                $viewData['photoInformation'] = $photoInformation;

            $viewModel->setVariables($viewData);
        }

        $viewModel->setVariables($viewData);
        return $viewModel;
    }

    public function uploadAction()
    {

        //anna 清除缓存作用
        $type = $this->params()->fromQuery("type");
        $outKeyId = $this->params()->fromQuery('outKeyId');
        $time = $this->params()->fromQuery('time');

        $fileName = $_FILES['upload']['name']; //get the name of uploaded file
        $uploadPath = realpath("public/images/photo");

        if (!$fileName) {
            echo "File path is empty!";
            die;
        }

        $extName = strtolower(substr(strrchr($fileName, "."), 1));
        $fileName = $outKeyId . $time . "." . $extName;

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/public/images/photo/" . $fileName)) {
            unlink($_SERVER['DOCUMENT_ROOT'] . "/public/images/photo/" . $fileName);
        }
        $db_photo = new Photo();
        $data = array('Type' => $type,
            'OutKeyId' => $outKeyId,
            'PhotoName' => $fileName);

        $rename = $db_photo->uploadPhoto($data, $uploadPath);

        return $this->response;
    }



    public function makedefaultAction()
    {
        $outKeyId = $this->params()->getParams("outKeyId");
        $object = $this->params()->getParams("object");
        $id= $this->params()->getParams("id");

        $fileTable = new DbTable\Image();
        $fileTable->update(array("Default"=>"0"), "OutKeyId='".$outKeyId."' and Object='".$object."'");
        $fileTable->update(array("Default"=>"1"), "Id=".$id);

        echo true;
        return $this->response;

    }

    public function resizePhotoToSquare($src_image)
    {

    }

    public function testAction()
    {
        $dhr_image = new DHR\DHRImage();
        $dhr_image->resize("public/img/icons/flags/belkin_wemo_insight_switch_side.jpg", 1);
        die;
        $targ_w = 641;
        $targ_h = 641;
        $img_r = imagecreatefromjpeg("public/img/icons/flags/belkin_wemo_insight_switch_side.jpg");
        $dst_r = ImageCreate($targ_w, $targ_h);
        $white = imagecolorallocate($dst_r, 255,255,255);
        imagefilledrectangle($dst_r, 0, 0, $targ_w, $targ_h, $white);
        imagecolortransparent($dst_r, $white);
        imagecopyresampled($dst_r, $img_r, 86, 0, 0, 0, 469, 641, 469, 641);
        imagejpeg($dst_r, "public/img/icons/flags/test.jpg", 100);
        die;
    }
} 