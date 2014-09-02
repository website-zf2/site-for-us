<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-25
 * Time: 下午3:13
 */

namespace Application\Model\DbTable;

use Application\Model\DbTable;
class Product extends DbTable {

   protected $tableName = "product";
   protected $ObjectIdPrefix = "P#";

   public function getObjectIdPrefix()
   {
      return $this->ObjectIdPrefix;
   }

    public function looksup($keyword)
    {
        $select = $this->sql->select();
        $select->where("ProductName like '%".$keyword."%'");
        return $this->fetchAll($select);
    }

    public function getRecordsByProductInnerIds($productInnerIds)
    {
        $select = $this->sql->select();
        $select->where("ProductInnerId IN('".implode("','", $productInnerIds)."')")
                    ->where( 'IsDeleted =0' );

        return $this->fetchAll($select);
    }

    public function getRecordByProductInnerId($productInnerId)
    {
        $select = $this->sql->select();
        $select->where("ProductInnerId ='".$productInnerId."'")
            ->where( 'IsDeleted =0' );

        return $this->fetchRow($select);
    }


    public function getAllProducts()
    {
        $select = $this->sql->select();
        $select->where( 'IsDeleted =0');

        return $this->fetchAll($select);
    }
} 