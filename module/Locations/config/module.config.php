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
        ],
    ],
    'api-tools-versioning' => [
        'uri' => [
            0 => 'locations.rest.local',
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
                2 => 'PUT',
                3 => 'DELETE',
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
        ],
        'accept_whitelist' => [
            'Locations\\V1\\Rest\\Local\\Controller' => [
                0 => 'application/vnd.locations.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            'Locations\\V1\\Rest\\Local\\Controller' => [
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
    ],
    'input_filter_specs' => [
        'Locations\\V1\\Rest\\Local\\Validator' => [
            0 => [
                'required' => false,
                'validators' => [],
                'filters' => [],
                'name' => 'id',
                'error_message' => 'ID validation failure',
            ],
            1 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'name',
                'error_message' => 'Name validation failure',
            ],
            2 => [
                'required' => true,
                'validators' => [],
                'filters' => [],
                'name' => 'type_id',
                'error_message' => 'Type_id validation failure',
            ],
        ],
    ],
];
