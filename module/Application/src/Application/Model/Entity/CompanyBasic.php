<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-20
 * Time: 上午9:53
 */

namespace Application\Model\Entity;


class CompanyBasic {

   protected $CompanyName;

   protected $Ecosystem;

   protected $ProfileImage;

   public function setCompanyName($companyName)
   {
      $this->CompanyName = $companyName;
      return $this;
   }

   public function getCompanyName()
   {
      return $this->CompanyName;
   }

   public function setEcosystem($Ecosystem)
   {
      $this->Ecosystem = $Ecosystem;
      return $this;
   }

   public function getEcosystem()
   {
      return $this->Ecosystem;
   }

   public function setProfileImage($ProfileImage)
   {
      $this->ProfileImage = $ProfileImage;
      return $this;
   }

   public function getProfileImage()
   {
      return $this->ProfileImage;
   }

   public function getArrayCopy()
   {
      return get_object_vars($this);
   }

} 