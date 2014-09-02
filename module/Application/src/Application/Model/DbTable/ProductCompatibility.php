<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-7-30
 * Time: 下午4:35
 */

namespace Application\Model\DbTable;

use Application\Model\DbTable;
class ProductCompatibility extends DbTable{

    protected $tableName = "product_compatibility";

    public function deleteCompatibility($masterNode)
    {
        //delete compatibility
        $this->delete("FromNode='".$masterNode."'");
        //reverse compatibility
        $this->delete("ToNode ='".$masterNode."'");
    }

    public function insertCompatibility($masterNode, $slaveNodes)
    {

        if(!empty($slaveNodes))
        {
            foreach($slaveNodes as $slaveNode)
            {
                //compatibility
                $insertData = array("FromNode"=>$masterNode, "ToNode"=>$slaveNode);
                $this->insert($insertData);

                //reverse compatibility
                $insertData = array("FromNode"=>$slaveNode, "ToNode"=>$masterNode);
                $this->insert($insertData);
            }
        }

    }

    public function getCompatibilityProduct($productInnerId)
    {
        $select = $this->sql->select();
        $select->where("FromNode='".$productInnerId."'")
                    ->where("IsDeleted='0'");

        return $this->fetchAll($select);

    }


} 