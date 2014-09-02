<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-24
 * Time: 下午4:33
 */

namespace Application\Model\DbTable;

use Application\Model;
class Person extends Model\DbTable{
   protected $tableName = "person";

   protected $ObjectIdPrefix = "PS#";

   public function getObjectIdPrefix()
   {
      return $this->ObjectIdPrefix;
   }

} 