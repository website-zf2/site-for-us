<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-8-6
 * Time: 下午3:49
 */

namespace Application\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\DbTable;
use DHR;
class FileController extends AbstractActionController{

    public function uploadAction(){

        $fileTable = new DbTable\Image();
        $insertToDB = $this->params()->getParams("insertDB", true);
        $imageType  = $this->params()->getParams("imageType");
        $outKeyId = $this->params()->getParams("outKeyId");
        $scale =  $this->params()->getParams("scale", false);

        $fileUploadPath = $fileTable->getImageFilePath($imageType);
        $object = $fileTable->getImageFileTypeId($imageType);
        $uploadHandler = new DHR\UploadHandler(array("upload_url"=>$fileUploadPath."/",'param_name'=>"upload"));

        switch ($_SERVER['REQUEST_METHOD']) {
            case 'OPTIONS':
                break;
            case 'HEAD':
            case 'GET':
                $uploadHandler->get();
                break;
            case 'POST':
                if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
                    $uploadHandler->delete();
                } else {
                    $info = $uploadHandler->post();
                    $fileInfo = $info[0];

                    //make sure have unique image
                    if($scale!==false)
                    {
                        $dhrImage = new DHR\DHRImage();
                        $fileInfo->url = $dhrImage->resize(urldecode($fileInfo->url), $scale);
                        $fileInfo->name = basename($fileInfo->url);
                    }
                    if(!isset($fileInfo->error) && $insertToDB===true)
                    {
                        $data = array(
                            'Object' => $object,
                            'Type' => $fileInfo->type,
                            'OutKeyId' => $outKeyId,
                            'FilePath' => $fileInfo->url,
                            'FileName' => $fileInfo->name,
                            'Size' => $fileInfo->size,
                        );

                        $fileTable->insert($data);
                    }
                    $json = json_encode($info);
                    echo $json;
                }
                break;
            case 'DELETE':
                $uploadHandler->delete();
                break;
            default:
                header('HTTP/1.1 405 Method Not Allowed');
        }
        return $this->response;
    }
} 