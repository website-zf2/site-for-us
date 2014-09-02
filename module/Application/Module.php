<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\Application;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceManager;
use Zend\Session\Container;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $serviceManager = $e->getApplication()->getServiceManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        //set default static adapter
        $adapterFactory = new \Zend\Db\Adapter\AdapterServiceFactory();
        $adapter = $adapterFactory->createService($serviceManager);
        \Zend\Db\TableGateway\Feature\GlobalAdapterFeature::setStaticAdapter($adapter);

        //set common config object
        \DHR\Config::setConfig($serviceManager);


        $localeSession = new Container();
        if (!empty($localeSession['language']))
        {
            $translator = $serviceManager->get("translator");
            $translator->setLocale($localeSession['language']);
        }
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                'formelement' => 'DHR\Form\View\Helper\FormElement',
                'formdemo' => 'DHR\Form\View\Helper\FormDemo',
                'formlabel' => 'DHR\Form\View\Helper\FormLabel',
                'formdateselect' => 'DHR\Form\View\Helper\FormDateSelect',
                'formcollection' => 'DHR\Form\View\Helper\FormCollection',
                'formdimensions' => 'DHR\Form\View\Helper\FormDimensions',
                'formmulticheckbox' => 'DHR\Form\View\Helper\FormMultiCheckbox',
                'formlooksup' => 'DHR\Form\View\Helper\FormLooksup',
                'formweight' => 'DHR\Form\View\Helper\FormWeight',
                'escapehtml'=>'DHR\View\Helper\EscapeHtml',
            )
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'companyTable' => function ($sm)
                    {
                        $companyTable = new \Application\Model\DbTable\Company();
                        return $companyTable;
                    },
            ),
        );
    }

    public function getFormElementConfig()
    {
        return array(
            'invokables' => array(
                'Application\Form\Fieldset\CompanyBasic' => 'Application\Form\Fieldset\CompanyBasic',
                'Application\Form\Fieldset\ProductBasic' => 'Application\Form\Fieldset\ProductBasic',
                'Application\Form\Fieldset\PersonBasic' => 'Application\Form\Fieldset\PersonBasic',
                'Application\Form\Fieldset\ProductDescription' => 'Application\Form\Fieldset\ProductDescription',
                'Application\Form\Fieldset\ProductCompatibility' => 'Application\Form\Fieldset\ProductCompatibility',
                'Application\Form\Fieldset\ProductConnectivity' => 'Application\Form\Fieldset\ProductConnectivity',
                'Application\Form\Fieldset\ProductDimensions' => 'Application\Form\Fieldset\ProductDimensions',
                'Application\Form\Fieldset\ProductFeature' => 'Application\Form\Fieldset\ProductFeature',
                'Application\Form\Fieldset\ProductGeneration' => 'Application\Form\Fieldset\ProductGeneration',
                'Application\Form\Fieldset\ProductInstallation' => 'Application\Form\Fieldset\ProductInstallation',
                'Application\Form\Fieldset\ProductKickOut' => 'Application\Form\Fieldset\ProductKickOut',
                'Application\Form\Fieldset\ProductPhoto' => 'Application\Form\Fieldset\ProductPhoto',
                'Application\Form\Fieldset\ProductPowerSupply' => 'Application\Form\Fieldset\ProductPowerSupply',
                'Application\Form\Fieldset\ProductSoftware' => 'Application\Form\Fieldset\ProductSoftware',
                'Application\Form\Fieldset\ProductVideo' => 'Application\Form\Fieldset\ProductVideo',
                'Application\Form\Fieldset\ProductSoftwareScreenShots' => 'Application\Form\Fieldset\ProductSoftwareScreenShots',
                'Application\Form\Fieldset\ProductColor' => 'Application\Form\Fieldset\ProductColor',

            )
        );
    }
}
