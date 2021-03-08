<?php
return [
    'service_manager' => [
        'factories' => [
            \Locations\V1\Rest\Local\LocalResource::class => \Locations\V1\Rest\Local\LocalResourceFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'locations.rest.local' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/local[/:local_id]',
                    'defaults' => [
                        'controller' => 'Locations\\V1\\Rest\\Local\\Controller',
                    ],
                ],
            ],
            'locations.rpc.local-type' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/localtype',
                    'defaults' => [
                        'controller' => 'Locations\\V1\\Rpc\\LocalType\\Controller',
                        'action' => 'localType',
                    ],
                ],
            ],
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'locations.rest.local',
            1 => 'locations.rpc.local-type',
        ],
    ],
    'api-tools-rest' => [
        'Locations\\V1\\Rest\\Local\\Controller' => [
            'listener' => \Locations\V1\Rest\Local\LocalResource::class,
            'route_name' => 'locations.rest.local',
            'route_identifier_name' => 'local_id',
            'collection_name' => 'local',
            'entity_http_methods' => [
                0 => 'GET',
                1 => 'PATCH',
                2 => 'DELETE',
            ],
            'collection_http_methods' => [
                0 => 'GET',
                1 => 'POST',
            ],
            'collection_query_whitelist' => [],
            'page_size' => '10',
            'page_size_param' => null,
            'entity_class' => \Locations\V1\Rest\Local\LocalEntity::class,
            'collection_class' => \Locations\V1\Rest\Local\LocalCollection::class,
            'service_name' => 'Local',
        ],
    ],
    'api-tools-content-negotiation' => [
        'controllers' => [
            'Locations\\V1\\Rest\\Local\\Controller' => 'HalJson',
            'Locations\\V1\\Rpc\\LocalType\\Controller' => 'Json',
        ],
        'accept_whitelist' => [
            'Locations\\V1\\Rest\\Local\\Controller' => [
                0 => 'application/vnd.locations.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'Locations\\V1\\Rpc\\LocalType\\Controller' => [
                0 => 'application/vnd.locations.v1+json',
                1 => 'application/json',
                2 => 'application/*+json',
            ],
        ],
        'content_type_whitelist' => [
            'Locations\\V1\\Rest\\Local\\Controller' => [
                0 => 'application/vnd.locations.v1+json',
                1 => 'application/json',
            ],
            'Locations\\V1\\Rpc\\LocalType\\Controller' => [
                0 => 'application/vnd.locations.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'api-tools-hal' => [
        'metadata_map' => [
            \Locations\V1\Rest\Local\LocalEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'locations.rest.local',
                'route_identifier_name' => 'local_id',
                'hydrator' => \Laminas\Hydrator\ArraySerializable::class,
            ],
            \Locations\V1\Rest\Local\LocalCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'locations.rest.local',
                'route_identifier_name' => 'local_id',
                'is_collection' => true,
            ],
        ],
    ],
    'api-tools-content-validation' => [
        'Locations\\V1\\Rest\\Local\\Controller' => [
            'input_filter' => 'Locations\\V1\\Rest\\Local\\Validator',
        ],
        'Locations\\V1\\Rpc\\LocalType\\Controller' => [
            'input_filter' => 'Locations\\V1\\Rpc\\LocalType\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Locations\\V1\\Rest\\Local\\Validator' => [
            0 => [
                'required' => false,
                'validators' => [],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\ToInt::class,
                        'options' => [],
                    ],
                ],
                'name' => 'id',
                'error_message' => 'ID validation failure',
            ],
            1 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'max' => '60',
                            'min' => '1',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StripTags::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                        'options' => [],
                    ],
                ],
                'name' => 'name',
                'error_message' => 'Name validation failure',
            ],
            2 => [
                'required' => false,
                'validators' => [],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\ToInt::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Laminas\Filter\ToNull::class,
                        'options' => [],
                    ],
                ],
                'name' => 'type_id',
                'error_message' => 'Type_id validation failure',
            ],
        ],
        'Locations\\V1\\Rpc\\LocalType\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => \Laminas\Validator\StringLength::class,
                        'options' => [
                            'min' => '1',
                            'max' => '30',
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\StripTags::class,
                        'options' => [],
                    ],
                    1 => [
                        'name' => \Laminas\Filter\StringTrim::class,
                        'options' => [],
                    ],
                ],
                'name' => 'name',
                'error_message' => 'Name validation failure',
            ],
            1 => [
                'required' => false,
                'validators' => [],
                'filters' => [
                    0 => [
                        'name' => \Laminas\Filter\ToInt::class,
                        'options' => [],
                    ],
                ],
                'name' => 'id',
                'error_message' => 'Id validation failure',
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            'Locations\\V1\\Rpc\\LocalType\\Controller' => \Locations\V1\Rpc\LocalType\LocalTypeControllerFactory::class,
        ],
    ],
    'api-tools-rpc' => [
        'Locations\\V1\\Rpc\\LocalType\\Controller' => [
            'service_name' => 'LocalType',
            'http_methods' => [
                0 => 'POST',
                1 => 'PATCH',
                2 => 'GET',
            ],
            'route_name' => 'locations.rpc.local-type',
        ],
    ],
];
