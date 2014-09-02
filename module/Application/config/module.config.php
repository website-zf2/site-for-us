<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action' => 'index',
                    ),
                ),
            ),

            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller' => 'Product',
                        'action' => 'list',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '[:controller][/:action]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(),
                        ),
                    ),
                ),
            ),
//               'album'=>array(
//                  'type' => "segment",
//                  'options'=>array(
//                     'route'=>'/album[/][:action][\:id]',
//                     'constraints'=>array(
//                        'action'=>'[a-zA-Z][a-zA-Z0-9_-]*',
//                        'id'=>'[0-9]+'
//                     ),
//                     'defaults'=>array(
//                        'controller'=>'Application\Controller\Album',
//                        'action'=>"index"
//                     )
//                  ),
//               ),
//           'product'=>array(
//              'type' => "segment",
//              'options'=>array(
//                 'route'=>'/product[/][:action][\:id]',
//                 'constraints'=>array(
//                    'action'=>'[a-zA-Z][a-zA-Z0-9_-]*',
//                    'id'=>'[0-9]+'
//                 ),
//                 'defaults'=>array(
//                    'controller'=>'Application\Controller\Product',
//                    'action'=>"index"
//                 )
//              ),
//           ),
        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type' => 'phparray',
                'base_dir' => APPLICATION_PATH . '/data/translation/application',
                'pattern' => '%s.php',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController',
            'Application\Controller\Album' => 'Application\Controller\AlbumController',
            'Application\Controller\Product' => 'Application\Controller\ProductController',
            'Application\Controller\Person' => 'Application\Controller\PersonController',
            'Application\Controller\Graphicdatabase' => 'Application\Controller\GraphicdatabaseController',
            'Application\Controller\File' => 'Application\Controller\FileController',
            'Application\Controller\Company' => 'Application\Controller\CompanyController',
            'Application\Controller\Photo' => 'Application\Controller\PhotoController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
            APPLICATION_PATH . '/vendor'
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(),
        ),
    ),


    'controller_plugins'=>array(
        'invokables'=>array(
            'params'=>'DHR\Controller\Plugin\Params'
        )
    )

);
