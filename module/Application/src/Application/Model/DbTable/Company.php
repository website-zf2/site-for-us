<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-18
 * Time: 下午3:49
 */

namespace Application\Model\DbTable;

use Application\Model;

class Company extends Model\DbTable {

   protected $tableName = 'company';

   protected $ObjectIdPrefix = "C#";

   public function getCompanyByCompanyId ($companyId)
   {
      $select = $this->sql->select();
      $select->where("CompanyId='".$companyId."'");
      return $this->fetchRow($select);
   }

   public function getObjectIdPrefix()
   {
      return $this->ObjectIdPrefix;
   }


}