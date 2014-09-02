<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-18
 * Time: 上午11:06
 */

namespace Application\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\ResultSet\ResultSet;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DbTable implements ServiceLocatorAwareInterface
{

    protected $tableName;
    protected $dbAdapter;
    protected $sql;
    protected $select;
    protected $resultSet;
    protected $serviceLocator;

    /**
     * Set serviceManager instance
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return void
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Retrieve serviceManager instance
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function __construct($tableName = null)
    {
        $this->dbAdapter = $dbAdapter = \Zend\Db\TableGateway\Feature\GlobalAdapterFeature::getStaticAdapter();
        $this->sql = new Sql($dbAdapter);
        if ($tableName != null)
            $this->tableName = $tableName;

        $this->sql->setTable($this->tableName);
        $this->resultSet = new ResultSet();
    }

    public function fetchAll($select = null)
    {
        if (!empty($select))
            $statement = $this->sql->prepareStatementForSqlObject($select);
        else
        {

            $statement = $this->sql->prepareStatementForSqlObject($this->sql->select());
        }

        //debug display sql string
//     echo $select->getSqlString($this->dbAdapter->getPlatform());die;
        $results = $statement->execute();
        if ($results)
            return $this->toArray($results);
        else
            return false;
    }

    public function fetchRow($select)
    {
        $select->limit(1);
        $result = $this->fetchAll($select);
        //   echo $select->getSqlString($this->dbAdapter->getPlatform());die;
        if ($result)
            return $result[0];
        else
            return false;
    }

    public function update($set, $where, $tableName = null)
    {
        $update = $this->sql->update($tableName);
        $update->set($set);
        $update->where($where);
        $statement = $this->sql->prepareStatementForSqlObject($update);
        //debug display sql string
        // echo $update->getSqlString($this->dbAdapter->getPlatform());die;
        $results = $statement->execute();
        return $results->count();
    }

    public function delete($where, $tableName = null)
    {
        $delete = $this->sql->delete($tableName);
        $delete->where($where);
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        //debug display sql string
        // echo $delete->getSqlString($this->dbAdapter->getPlatform());die;
        $results = $statement->execute();
        return $results->count();
    }

    public function insert($data, $tableName = null)
    {
        $insert = $this->sql->insert($tableName);
        $insert->values($data);
        $statement = $this->sql->prepareStatementForSqlObject($insert);

        //debug display sql string
        // echo $insert->getSqlString($this->dbAdapter->getPlatform());die;

        $results = $statement->execute();
        return $results->getGeneratedValue();
        //return $this->toArray($results);
    }

    public function toArray($results)
    {
        if ($results->count() > 0)
            return $this->resultSet->initialize($results)->toArray();
        else
            return false;
    }

    public function getResultRet()
    {
        return $this->resultSet;
    }

    public function getSql()
    {
        return $this->sql;
    }


}