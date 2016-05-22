<?php
return [
    'service_manager' => [
        'factories' => [
            'Strapieno\Utils\Listener\ListenerManager' => 'Strapieno\Utils\Listener\ListenerManagerFactory'
        ],
        'invokables' => [
            'Strapieno\Utils\Delegator\AttachListenerDelegator' =>  'Strapieno\Utils\Delegator\AttachListenerDelegator'
        ],
        'aliases' => [
            'listenerManager' => 'Strapieno\Utils\Listener\ListenerManager'
        ]
    ],
    // Register listener to listener manager
    'service-listeners' => [
        'initializers' => [
            'Strapieno\NightClub\Model\NightClubModelInizializer'
        ],
        'invokables' => [
            'Strapieno\NightClubCover\Api\Listener\NightClubRestListener'
                => 'Strapieno\NightClubCover\Api\Listener\NightClubRestListener'
        ]
    ],
    'attach-listeners' => [
        'Strapieno\NightClubCover\Api\V1\Rest\Controller' => [
            'Strapieno\NightClubCover\Api\Listener\NightClubRestListener'
        ]
    ],
    'controllers' => [
        'delegators' => [
            'Strapieno\NightClubCover\Api\V1\Rest\Controller' => [
                'Strapieno\Utils\Delegator\AttachListenerDelegator',
            ]
        ],
    ],
    'router' => [
        'routes' => [
            'api-rest' => [
                'child_routes' => [
                    'nightclub' => [
                        'child_routes' => [
                            'cover' => [
                                'type' => 'Segment',
                                'options' => [
                                    'route' => '/cover',
                                    'defaults' => [
                                        'controller' => 'Strapieno\NightClubCover\Api\V1\Rest\Controller'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ],
    'imgman-apigility' => [
        'imgman-connected' => [
            'Strapieno\NightClubCover\Api\V1\Rest\ConnectedResource' => [
                'service' => 'ImgMan\Service\NightClubCover'
            ],
        ],
    ],
    'zf-rest' => [
        'Strapieno\NightClubCover\Api\V1\Rest\Controller' => [
            'service_name' => 'nightclub-cover',
            'listener' => 'Strapieno\NightClubCover\Api\V1\Rest\ConnectedResource',
            'route_name' => 'api-rest/nightclub/cover',
            'route_identifier_name' => 'nightclub_id',
            'entity_http_methods' => [
                0 => 'GET',
                2 => 'PUT',
                3 => 'DELETE'
            ],
            'page_size' => 10,
            'page_size_param' => 'page_size',
            'collection_class' => 'Zend\Paginator\Paginator',
            'entity_class' => 'Strapieno\NightClubCover\Model\Entity\NightClubEntity'
        ]
    ],
    'zf-content-negotiation' => [
        'accept_whitelist' => [
            'Strapieno\NightClubCover\Api\V1\Rest\Controller' => [
                'application/hal+json',
                'application/json'
            ],
        ],
        'content_type_whitelist' => [
            'Strapieno\NightClubCover\Api\V1\Rest\Controller' => [
                'application/json',
                'multipart/form-data',
            ],
        ],
    ],
    'zf-hal' => [
        // map each class (by name) to their metadata mappings
        'metadata_map' => [
            'Strapieno\NightClubCover\Model\Entity\NightClubEntity' => [
                'entity_identifier_name' => 'id',
                'route_name' => 'api-rest/nightclub/cover',
                'route_identifier_name' => 'nightclub_id'
            ],
        ],
    ],
    'zf-content-validation' => [
        'Strapieno\NightClubCover\Api\V1\Rest\Controller' => [
            'input_filter' => 'NightClubCoverInputFilter',
        ],
    ],
    'strapieno_input_filter_specs' => [
        'NightClubCoverInputFilter' => [
            [
                'name' => 'blob',
                'required' => true,
                'allow_empty' => false,
                'continue_if_empty' => false,
                'validators' => [
                    0 => [
                        'name' => 'fileuploadfile',
                        'break_chain_on_failure' => true,
                    ],
                    1 => [
                        'name' => 'filesize',
                        'break_chain_on_failure' => true,
                        'options' => [
                            'min' => '20KB',
                            'max' => '8MB',
                        ],
                    ],
                    2 => [
                        'name' => 'filemimetype',
                        'options' => [
                            'mimeType' => [
                                'image/png',
                                'image/jpeg',
                            ],
                            'magicFile' => false,
                        ],
                    ],
                ],
            ],
        ],
    ],
];
