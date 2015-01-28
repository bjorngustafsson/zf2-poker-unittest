<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Player\Controller\Player' => 'Player\Controller\PlayerController',
        ),
    ),

    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'player' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/player[/][:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Player\Controller\Player',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),


    'view_manager' => array(
        'template_path_stack' => array(
            'player' => __DIR__ . '/../view',
        ),
    ),
);