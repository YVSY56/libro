<?php

return array(
        'controllers' => array(
            'invokables' => array(
                // llamado del controlador
                    'Libro\Controller\Libro' => 'Libro\Controller\LibroController'
            ),      
        ),
        // configuracion de la ruta
        'router'=>array(
                'routes' => array(
                        'crud' => array(
                        'type' => 'Segment',
                        'options' => array(
                            // ruta con los parametros
                                'route' => '/libro[/[:action]][/:id]',
                                'constraints' => array(
                                        'action'=> '[a-zA-z][a-zA-Z0-9_-]*',
                                ),
                                
                                'defaults' => array(
                                        'controller' => 'Libro\Controller\Libro',
                                        'action'     => 'index'
                                
                                ),
                        ),
                ),
        ),
    ),


    'view_manager' => [
        'template_path_stack' => [
            'libro' => __DIR__ . '/../view',
        ],
    ],
        
);