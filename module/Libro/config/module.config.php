<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Libro;


use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [

    // The following section is new and should be added to your file:
    'router' => [
        'routes' => [
            'libro' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/libro[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\LibroController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'libro' => __DIR__ . '/../view',
        ],
    ],
];