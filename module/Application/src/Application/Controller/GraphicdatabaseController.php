<?php
/**
 * Created by PhpStorm.
 * User: RayZheng
 * Date: 8/5/14
 * Time: 5:07 下午
 */

namespace Application\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Everyman\Neo4j;
use Application\Model;
use Application\Model\DbTable;
use DHR;

class GraphicdatabaseController extends AbstractActionController{

    public function syncproductAction()
    {
        $productCompatibilityTable = new DbTable\ProductCompatibility();
        $productTable = new DbTable\Product();
        $productCompatibility = $productCompatibilityTable->fetchAll();
        $neo4jClient = new Neo4j\Client(DHR\Config::getConfigByPath('gdb.host'), DHR\Config::getConfigByPath('gdb.port'));
        //initial the multiple options node.
        $optionsObject = new DHR\String();
        $labels = $optionsObject->getAllMultipleOption();
        //$neoQuery = new Neo4j\Cypher\Query($neo4jClient, "MATCH (a)-[r]-() DELETE r,a");
        $neoQuery = new Neo4j\Cypher\Query($neo4jClient, "MATCH (product:Product{name:'p1'}) RETURN product");

        $temp = $neo4jClient->executeCypherQuery($neoQuery);
        var_dump($temp[0]['product']->getProperty('name'));die;
        foreach($labels as $label=>$selectNode)
        {
            $neoLabel = $neo4jClient->makeLabel($label);
            //remove all the node with label

            //print_r($neoQuery->getResultSet());
            foreach($selectNode as $key=>$option)
            {
                $valueNode = $neo4jClient->makeNode()->setProperties(array('Id'=>$label . '_' . $key, 'SelectId'=>$key,'Name'=>$option))->save();
                $valueNode->addLabels(array($neoLabel));
                $addedNode[$label][$key] = $valueNode;
                echo $valueNode->getProperty('Name') . "\r\n";
            }
        }
        //remove all original record in the Neo4j
        $neoQuery = new Neo4j\Cypher\Query($neo4jClient, "MATCH (a)-[r:Compatibility]-() DELETE r,a");
        //print_r($neoQuery->getResultSet());
        if($productCompatibility)
        {
            $productLabel = $neo4jClient->makeLabel('Product');
            foreach($productCompatibility as $product)
            {
                $nodes = $productTable->getRecordsByProductInnerIds(array($product['FromNode'],$product['ToNode']));
                if(count($nodes) == 2)
                {
                    $node[0]['Id'] = $node[0]['ProductInnerId'];
                    $node[1]['Id'] = $node[1]['ProductInnerId'];
                    $productNode = $neo4jClient->getNodeByInnerId($node[0]['ProductInnerId']);
                    if($productNode) //check the from product existed.
                    {
                        $from = $productNode;
                        $fromExist = true;
                    }else
                    {
                        $from = $neo4jClient->makeNode()->setProperties($nodes[0])->save();
                        $from->addLabels(array($productLabel));
                        $fromExist = false;
                    }

                    $productNode = $neo4jClient->getNodeByInnerId($node[1]['ProductInnerId']);
                    if($productNode) //check the to product existed.
                    {
                        $to = $productNode;
                        $toExist = true;
                    }else
                    {
                        $to = $neo4jClient->makeNode()->setProperties($nodes[1])->save();
                        $to->addLabels(array($productLabel));
                        $toExist = false;
                    }

                    foreach($labels as $label=>$field)
                    {
                        for($i=0;$i<=1;$i++)
                        {
                            if(isset($nodes[$i][$label]))
                            {
                                $values = explode('&&&',$nodes[$i][$label]);
                                foreach($values as $value)
                                {
                                    if(isset($addedNode[$label][$value]))
                                    {
                                        if($i==0 && !$fromExist)
                                            $from->relateTo($addedNode[$label][$value],$label)->save();
                                        elseif(!$toExist)
                                            $to->relateTo($addedNode[$label][$value],$label)->save();
                                    }
                                }
                            }
                        }

                    }
                    //$from->relateTo($to, 'Compatibility')->save();
                    //$to->relateTo($from, 'Compatibility')->save();
                }
            }
        }
        return $this->response;
    }
} 