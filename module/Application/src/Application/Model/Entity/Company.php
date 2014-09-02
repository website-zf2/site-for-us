<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-20
 * Time: 上午10:08
 */

namespace Application\Model\Entity;

use Application\Model\Entity\CompanyBasic;
class Company {

   protected $CompanyBasic;

   public function setCompanyBasic( CompanyBasic $companyBasic)
   {
      $this->companyBasic = $companyBasic;
      return $this;
   }

   public function getCompanyBasic()
   {
      return $this->CompanyBasic;
   }

   public function getArrayCopy()
   {
      return get_object_vars($this);
   }

   public function exchangeArray($data)
   {
      $this->CompanyBasic     = (isset($data['CompanyBasic'])) ? $data['CompanyBasic'] : null;
   }
} 