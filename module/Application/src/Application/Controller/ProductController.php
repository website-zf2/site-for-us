<?php
/**
 * Created by PhpStorm.
 * User: Bob
 * Date: 14-6-23
 * Time: 下午4:41
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Validator\AbstractValidator;
use Zend\Session\Container;
use Application\Form;
use Application\Form\InputFilter;
use Application\Model;
use DHR;
use Zend\View\View;
use Everyman\Neo4j;

class ProductController extends AbstractActionController
{

    public function indexAction()
    {

        $viewModel = new ViewModel();
        $db_product = new Model\DbTable\Product();
        $db_productCompatibility = new Model\DbTable\ProductCompatibility();
        $db_image = new Model\DbTable\Image();
        $fn_file = new DHR\File();
        $fn_date = new DHR\Date();

        $productFileKeys = array(array("name"=>"ProductImage","fieldset"=>"ProductBasic"),
            array("name"=>"ProductSoftwareScreenShots", "fieldset"=>""),
                "ProductPhotos", "ProductVideos");

        $productFileKeys = array("ProductImage",
          "ProductSoftwareScreenShots",
            "ProductPhotos", "ProductVideos");

        $productUploadFiles = array();
        foreach($productFileKeys as $value)
        {
            $productFiles[$value] = array(
                    "uploadFileTypeId"=>$db_image->getImageFileTypeId($value),
                    'uploadFilePathPrefix'=>$db_image->getImageFilePath($value),
                    'name'=>$value
                );
        }

        $form = new Form\Product();
        $form_fieldsets = $form->getFieldsets();
        $form_fieldsetsName = array_keys($form_fieldsets);
        $viewData = array();
        $request = $this->getRequest();
        if ($request->isPost())
        {

            $post = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            $form->setData($post);

            if ($form->isValid())
            {

                $postData = $form->getData();
                $tempId = $postData['tempId'];
                unset($postData['tempId']);

                $productData['ProductId'] = $postData['ProductId'];
                $productData['ProductInnerId'] = $postData['ProductInnerId'];
                foreach ($form_fieldsetsName as $fieldName)
                    $productData = array_merge($productData, $postData[$fieldName]);

                $productData['Launched'] = implode("-", $productData['Launched']);
                //Dimensions prepare
                $productData['DimensionsHeight'] = $productData['Dimensions']['height'];
                $productData['DimensionsWidth'] = $productData['Dimensions']['width'];
                $productData['DimensionsDepth'] = $productData['Dimensions']['depth'];
                unset($productData['Dimensions']);
                $productData['Weight'] =  $productData['Weight']['g_weight'];
                //unset($productData['Weight']);

                //profile image prepare
                foreach($productFileKeys as $value)
                {
                    $productUploadFiles[$value] = $productData[$value];
                    unset($productData[$value]);
                }

                //prepare product compatibility
                $productCompatibility = $productData['productCompatibility'];
                unset( $productData['productCompatibility'] );

                //multi check box and select value prepare
                $multiCheckBoxKeys = array("PowerSupply", "Connectivity", "OSCompatibility", "ProductCategory", "RegionalAvailability", "Color");
                foreach ($multiCheckBoxKeys as $value)
                {
                    if(is_array($productData[$value]))
                        $productData[$value] = implode("&&&", $productData[$value]);
                }

                if (empty($postData['ProductId']) && empty($postData['ProductInnerId']))
                {
                    //create new record
                    $id = $db_product->insert($productData);
                    $objectIdPrefix = $db_product->getObjectIdPrefix();
                    $strPadId = str_pad($id, 8, 0, STR_PAD_LEFT);
                    $productData['ProductId'] = $objectIdPrefix . $strPadId;
                    $productData['ProductInnerId'] = str_replace("#", "", $objectIdPrefix) . $strPadId;
                    $db_product->update(array("ProductId" => $productData['ProductId'], "ProductInnerId" => $productData['ProductInnerId']), "Id=" . $id);
                }
                else
                {
                    $db_product->update($productData, "ProductId='" . $productData['ProductId'] . "' AND ProductInnerId='" . $productData['ProductInnerId'] . "'");
                }

                //upload file
                $fileNames = array();
                foreach($productUploadFiles as $uploadFileKey=> $uploadFile)
                {
                    if (!empty($uploadFile['name']))
                    {
                        $uploadFilePathPrefix = $productFiles[$uploadFileKey]['uploadFilePathPrefix'];
                        $fileNames["ProductBasic_".$uploadFileKey."_"] = $uploadFile['name'];
                        $uploadFilesPathPrefix["ProductBasic_".$uploadFileKey."_"] = $uploadFilePathPrefix;
                    }
                }
                $reFileNames = $fn_file->uploadFile($fileNames, $uploadFilesPathPrefix);

                foreach($productUploadFiles as $uploadFileKey=> $uploadFile)
                {
                    if(!empty($reFileNames['ProductBasic_'.$uploadFileKey.'_']))
                    $db_image->insert(array(
                        'Type' => $productFiles[$uploadFileKey]['uploadFileTypeId'],
                        'FilePath' => $reFileNames['ProductBasic_'.$uploadFileKey.'_'],
                        'FileName' => $uploadFile['name'],
                        'OutKeyId' => $productData['ProductInnerId']
                    ));
                }

                //insert product compatibility
                //delete all compatibility regarding this product
                $db_productCompatibility->deleteCompatibility($productData['ProductInnerId']);
                $db_productCompatibility->insertCompatibility($productData['ProductInnerId'], $productCompatibility);

                //then insert the compatibility regarding this product

                $viewData['insert'] = true;

                if($tempId!=$productData['ProductInnerId'])
                {
                    $db_image->update(array("OutKeyId"=>$productData['ProductInnerId']), "OutKeyId='".$tempId."'");
                }
                return  $this->redirect()->toUrl("/product/index?read=true&id=".$productData['ProductInnerId']);

            }
            else
            {
                $message = $form->getMessages();
                $viewData['insert'] = false;
            }
        }
        else if($this->params()->fromQuery("id"))
        {
            $viewData['productInnerId'] = $productInnerId = $this->params()->fromQuery("id");
            $viewData['data'] = $db_product->getRecordByProductInnerId($productInnerId);
            $viewData['read'] = $this->params()->fromQuery("read", false);
        }
        else {
            $viewData['add'] = true;
            $form->remove("ProductSoftwareScreenShots");
            $form->remove("ProductVideo");
            $form->remove("ProductPhoto");
        }
        $viewData['form'] = $form;

        $viewModel->setVariables($viewData);
        return  $viewModel;
    }

    public function playbookAction()
    {
        $keyword = $this->params()->fromQuery('keyword');

        $queryField = '';
        $queryWhere = '';
        $queryPrice = '';
        $queryWith = '';
        $queryWhereOS = '';
        $nodes = array();
        $startId = $this->params()->fromQuery('Id');
        $neoClient = new Neo4j\Client(DHR\Config::getConfigByPath('gdb.host'), DHR\Config::getConfigByPath('gdb.port'));
        if($startId)
        {
            $query = "START head=node:node_auto_index(Id='$startId') MATCH ProductGroup = head-[r:Compatible*]-(n) RETURN ProductGroup";
            $neoQuery = new Neo4j\Cypher\Query($neoClient, $query);
            $results = $neoQuery->getResultSet();
            foreach($results as $result)
            {
                $relationships = $result['ProductGroup']->getRelationships();
                $links = array();

                foreach($relationships as $relationship)
                {
                    $links[] = array('source'=>$relationship->getStartNode()->getProperty('name'), 'target'=>$relationship->getEndNode()->getProperty('name'));
                }
                $d3Liks[] = $links;
            }
        }else
        {
            //get all product
            $query = 'MATCH (product:Product) RETURN product';
            $neoQuery = new Neo4j\Cypher\Query($neoClient, $query);
            $results = $neoQuery->getResultSet();
            $ids = '';
            $i = 0;
            $groupColor = 0;
            foreach($results as $result)
            {
                $ids .= $result[0]->getId() . ',';
                $result[0]->setProperty('group',$groupColor++);
                //$result[0]->setProperty('fixed',true);
                $nodes[$i] = $result[0]->getProperties();
                $nodesMap[$result[0]->getId()] = $i;
                $i++;
            }
            $ids = substr($ids,0,-1);
            //get all relationships from above ids, the code from neo4j browser, don't ask me why.
            $query = "START a=node($ids), b=node($ids) MATCH a-[r:Compatible]-b RETURN r";
            $neoQuery = new Neo4j\Cypher\Query($neoClient, $query);
            $results = $neoQuery->getResultSet();

            $links = array();
            foreach ($results as $result)
            {
                $links[] = array('source'=>$nodesMap[$result[0]->getStartNode()->getId()], 'target'=>$nodesMap[$result[0]->getEndNode()->getId()],'value'=>1,'weight'=>3);
            }

            //statistic
            $query = "START product=node($ids) MATCH product-[r:Category|:OSCompebility]->(categoryName) WITH type(r) AS category,categoryName, COUNT(categoryName) AS categoryNameCount RETURN category,categoryName.name,categoryNameCount";
            $neoQuery = new Neo4j\Cypher\Query($neoClient, $query);
            $results = $neoQuery->getResultSet();
            foreach ($results as $result)
            {
                $filters[$result['category']][$result['categoryName.name']] = $result['categoryNameCount'];
            }
        }

        /*if($this->getRequest()->isPost())
        {
            $filter = $this->params()->fromPost();
        }else
        {
            $filter = array('filter_country'=>'China',
                            'filter_type'=>array('Vacuum Cleaner', 'Camera', 'Light', 'Plug', 'Thermostat', 'Scale', 'Lock','Hub'),
                            'camera_number' => 1,
                            'light_number' => 1,
                            'filter_os' => array('Android','IOS','MacOSX','Microsoft')
            );
        }
        if(isset($filter['filter_type']))
        {
            foreach($filter['filter_type'] as $type)
            {
                if($queryField!='')
                    $queryField.="-[]-(`$type` {type:'$type'})";
                else
                    $queryField = "MATCH(`$type` {type:'$type'})";
                if($queryPrice!='')
                    $queryPrice.='+`' . $type . '`.Price';
                else
                    $queryPrice = '`' . $type . '`.Price';
            }
            $queryPrice .= ' AS TotalPrice';
        }
        if(isset($filter['camera_number']))
        {
            if($queryWhere=='')
                $queryWhere = " WHERE Camera.Number>=" . $filter['camera_number'];
            else
                $queryWhere .= " AND Camera.Number>=" . $filter['camera_number'];
        }
        if(isset($filter['light_number']))
        {
            if($queryWhere=='')
                $queryWhere = " WHERE Light.Number>=" . $filter['light_number'];
            else
                $queryWhere .= " AND Light.Number>=" . $filter['light_number'];
        }
        if(isset($filter['filter_os']))
        {
            foreach($filter['filter_os'] as $os)
            {
                if($queryWhereOS == '')
                    $queryWhereOS = "OS='$os'";
                else
                    $queryWhereOS = " OR OS='$os'";
            }
            if($queryWhere=='')
                $queryWhere = " WHERE ($queryWhereOS)";
            else
                $queryWhere .= " AND ($queryWhereOS)";
        }
        if(isset($filter['budget']))
        {
            $budget = str_replace(array('$',' '),'', $filter['budget']);
            $budget = explode('-',$budget);
            if($queryWhere =='')
                $queryWhere = ' WHERE TotalPrice >= ' . $budget[0] . ' AND ' . 'TotalPrice <= ' . $budget[1];
            else
                $queryWhere .= 'AND TotalPrice >= ' . $budget[0] . ' AND ' . 'TotalPrice <= ' . $budget[1];
            if($queryWith == '')
                $queryWith = ' WITH ' . $queryPrice;
            else
                $queryWith .= ', ' . $queryPrice;
        }
        $query = $queryField . $queryWith . $queryWhere . ' RETURN *';*/
        $view = new ViewModel(array('nodes'=>$nodes,'links'=>$links,'filters'=>$filters));

        return $view;
    }

    public function looksupAction()
    {


        $viewModel = new ViewModel();
        $viewModel->setTemplate("/application/looksup/index.phtml");
        $this->layout("layout/empty.phtml");


        $obj = $this->params()->fromQuery("obj");
        $viewData['obj'] = $obj;
        $form = new Form\Looksup();
        $db_product = new Model\DbTable\Product();
        $tableData = array(
            'Id' => 'ProductInnerId',
            'ShowContent' => 'ProductName',
            'Title' => array("Product Id", "Product Name"),
            'Data' => array("ProductId", "ProductName")
        );
        $viewData['table'] = $tableData;

        $request = $this->getRequest();
        if ($request->isPost())
        {
            $post = array_merge_recursive(
                $request->getPost()->toArray()
            );
            $form->setData($post);

            if ($form->isValid())
            {

                $postData = $form->getData();
                $keyword = $postData['Keyword'];

                $results = $db_product->looksup($keyword);

                if ($results)
                    $viewData['data'] = $results;
            }
        }
        $viewData['form'] = $form;
        $viewModel->setVariables($viewData);
        return $viewModel;

    }

    public function listAction()
    {
        $viewData = array();
        $viewModel = new ViewModel();

        $db_product = new Model\DbTable\Product();
        $products = $db_product->getAllProducts();

        $viewData['products'] = $products;
        $viewModel->setVariables($viewData);
        return $viewModel;

    }
} 