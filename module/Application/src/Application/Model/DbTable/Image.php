<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-25
 * Time: 上午10:08
 */

namespace Application\Model\DbTable;

use Application\Model\DbTable;
class Image extends DbTable{

   protected $tableName = "images";

   protected $imageFilePathPrefix = array(
                                                                'person'=>   '/files/person',
                                                                'ProductImage'=>'/files/product',
                                                                'ProductSoftwareScreenShots'=>"/files/product/screenshots",
                                                                'ProductPhotos'=>"/files/product/photos",
                                                                'ProductVideos'=>"/files/product/videos",
                                                                'ProductInstallationGuide'=>"/files/product/installationGuide",
                                                                'company'=>'/files/company'
                                                     );
   protected $imageFileTypeId = array(
                                                                'person'=>'1',
                                                                'company'=>'2',
                                                                'ProductImage'=>'3',
                                                                'ProductSoftwareScreenShots'=>"4",
                                                                'ProductPhotos'=>"5",
                                                                'ProductVideos'=>"6",
                                                                'ProductInstallationGuide'=>"7",
                                                    );


   public function getImageFilePath($type)
   {
      return $this->imageFilePathPrefix[$type];
   }

   public function getImageFileTypeId($type)
   {
      return $this->imageFileTypeId[$type];
   }

   public function getImages($object, $outKeyId)
   {
       $select = $this->sql->select();
       $select->where("OutKeyId='".$outKeyId."'")->where("IsDeleted = '0'");
       if(!empty($object))
           $select->where("Object='".$object."'");

       $select->order(array("Default DESC", "Id DESC"));
       return $this->fetchAll($select);
   }
} 