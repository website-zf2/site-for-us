<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-25
 * Time: 上午11:16
 */

namespace DHR;

use Zend\File\Transfer\Adapter;
use Zend\Filter\File as FilterFile;

class File {

   /**
    * 重命名: 在原文件上加上时间撮
    * @param <String> $fileName
    * @return <String> $reFileName
    */
   public function setFileRename( $fileName )
   {
      $extension = substr(strrchr($fileName, "."),1);
      $bodyName = basename($fileName, "." . $extension);
      $date = time();
      return $bodyName. $date . ".".$extension;
   }

   /** load file to server
    * @param null $fileNames
    * @param null $uploadPath
    */
   public function uploadFile($fileNames = null, $uploadPath = null)
   {
      $adapter = new Adapter\Http();
      $adapter->clearValidators();
      $files = $adapter->getFileInfo();

      $reFileNameArray = array();

      foreach ( $files as $file => $info){
          if(!isset($uploadPath[$file]) || !is_dir(PUBLIC_PATH . $uploadPath[$file]))
          continue ;
          $adapter->setDestination(PUBLIC_PATH.$uploadPath[$file]);
         if($adapter->isValid($file))
         {
            if($adapter->receive($file))
            {

               $reFileName=$this->setFileRename($fileNames[$file]);
               $fullUploadPath = PUBLIC_PATH. $uploadPath[$file] . '/' . $reFileName;

               $filterFileRename = new FilterFile\Rename(array('target' => $fullUploadPath, 'overwrite' => true));
               $filterFileRename->filter( PUBLIC_PATH.$uploadPath[$file] . '/' . $fileNames[$file]);

               $reFileNameArray[$file] = $uploadPath[$file] . '/' . $reFileName;
            }
            else{
               $messages= $adapter->getMessages();
               echo implode("\n", $messages);
               die;
            }
         }
         else{
            var_dump($adapter->getErrors());
            var_dump($adapter->getMessages());
            die;
         }


      }

       return $reFileNameArray;
   }
} 