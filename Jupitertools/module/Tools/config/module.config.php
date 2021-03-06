<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Tools\Controller\Monitor' => 'Tools\Controller\MonitorController',
            'Tools\Controller\Check' => 'Tools\Controller\CheckController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'monitor' => array(
                'type'    => 'segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/monitor[/:action][/:id]',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Tools\Controller',
                        'controller'    => 'Monitor',
                        'action'        => 'index',
                        'id'        => 'id',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'check' => array(
                'type'    => 'segment',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/check[/:action][/:id]',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Tools\Controller',
                        'controller'    => 'Check',
                        'action'        => 'index',
                        'id'        => 'id',
                    ),
                ),
                'may_terminate' => true,
              
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Tools' => __DIR__ . '/../view',
        ),
    ),
);
