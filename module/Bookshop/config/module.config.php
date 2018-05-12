<?php
return [
    'doctrine' => [
        'driver' => [
            'Bookshop_driver' => [
                'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [
                    0 => './module/Bookshop/src/V1/Entity',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'Bookshop' => 'Bookshop_driver',
                ],
            ],
        ],
    ],
    'router' => [
        'routes' => [
            'bookshop.rest.doctrine.books' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/books[/:books_id]',
                    'defaults' => [
                        'controller' => 'Bookshop\\V1\\Rest\\Books\\Controller',
                    ],
                ],
            ],
            'bookshop.rest.doctrine.authors' => [
                'type' => 'Segment',
                'options' => [
                    'route' => '/authors[/:authors_id]',
                    'defaults' => [
                        'controller' => 'Bookshop\\V1\\Rest\\Authors\\Controller',
                    ],
                ],
            ],
        ],
    ],
    'zf-versioning' => [
        'uri' => [
            0 => 'bookshop.rest.doctrine.books',
            1 => 'bookshop.rest.doctrine.authors',
        ],
    ],
    'zf-rest' => [
        'Bookshop\\V1\\Rest\\Books\\Controller' => [
            'listener' => \Bookshop\V1\Rest\Books\BooksResource::class,
            'route_name' => 'bookshop.rest.doctrine.books',
            'route_identifier_name' => 'books_id',
            'entity_identifier_name' => 'id',
            'collection_name' => 'books',
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
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Bookshop\V1\Entity\Books::class,
            'collection_class' => \Bookshop\V1\Rest\Books\BooksCollection::class,
            'service_name' => 'Books',
        ],
        'Bookshop\\V1\\Rest\\Authors\\Controller' => [
            'listener' => \Bookshop\V1\Rest\Authors\AuthorsResource::class,
            'route_name' => 'bookshop.rest.doctrine.authors',
            'route_identifier_name' => 'authors_id',
            'entity_identifier_name' => 'id',
            'collection_name' => 'authors',
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
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => \Bookshop\V1\Entity\Authors::class,
            'collection_class' => \Bookshop\V1\Rest\Authors\AuthorsCollection::class,
            'service_name' => 'Authors',
        ],
    ],
    'zf-content-negotiation' => [
        'controllers' => [
            'Bookshop\\V1\\Rest\\Books\\Controller' => 'HalJson',
            'Bookshop\\V1\\Rest\\Authors\\Controller' => 'HalJson',
        ],
        'accept-whitelist' => [
            'Bookshop\\V1\\Rest\\Books\\Controller' => [
                0 => 'application/vnd.bookshop.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
            'Bookshop\\V1\\Rest\\Authors\\Controller' => [
                0 => 'application/vnd.bookshop.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content-type-whitelist' => [
            'Bookshop\\V1\\Rest\\Books\\Controller' => [
                0 => 'application/vnd.bookshop.v1+json',
                1 => 'application/json',
            ],
            'Bookshop\\V1\\Rest\\Authors\\Controller' => [
                0 => 'application/vnd.bookshop.v1+json',
                1 => 'application/json',
            ],
        ],
        'accept_whitelist' => [
            'Bookshop\\V1\\Rest\\Authors\\Controller' => [
                0 => 'application/json',
                1 => 'application/*+json',
            ],
        ],
        'content_type_whitelist' => [
            'Bookshop\\V1\\Rest\\Authors\\Controller' => [
                0 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            \Bookshop\V1\Entity\Books::class => [
                'route_identifier_name' => 'books_id',
                'entity_identifier_name' => 'id',
                'route_name' => 'bookshop.rest.doctrine.books',
                'hydrator' => 'Bookshop\\V1\\Rest\\Books\\BooksHydrator',
            ],
            \Bookshop\V1\Rest\Books\BooksCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'bookshop.rest.doctrine.books',
                'is_collection' => true,
            ],
            \Bookshop\V1\Entity\Authors::class => [
                'route_identifier_name' => 'authors_id',
                'entity_identifier_name' => 'id',
                'route_name' => 'bookshop.rest.doctrine.authors',
                'hydrator' => 'Bookshop\\V1\\Rest\\Authors\\AuthorsHydrator',
            ],
            \Bookshop\V1\Rest\Authors\AuthorsCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'bookshop.rest.doctrine.authors',
                'is_collection' => true,
            ],
            'Doctrine\ORM\PersistentCollection' => array(
                'hydrator' => 'ArraySerializable',
                'isCollection' => true,
            ),
        ],
    ],
    'zf-apigility' => [
        'doctrine-connected' => [
            \Bookshop\V1\Rest\Books\BooksResource::class => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator' => 'Bookshop\\V1\\Rest\\Books\\BooksHydrator',
            ],
            \Bookshop\V1\Rest\Authors\AuthorsResource::class => [
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator' => 'Bookshop\\V1\\Rest\\Authors\\AuthorsHydrator',
            ],
        ],
    ],
    'doctrine-hydrator' => [
        'Bookshop\\V1\\Rest\\Books\\BooksHydrator' => [
            'entity_class' => \Bookshop\V1\Entity\Books::class,
            'object_manager' => 'doctrine.entitymanager.orm_default',
            'by_value' => true,
            'strategies' => [],
            'use_generated_hydrator' => true,
        ],
        'Bookshop\\V1\\Rest\\Authors\\AuthorsHydrator' => [
            'entity_class' => \Bookshop\V1\Entity\Authors::class,
            'object_manager' => 'doctrine.entitymanager.orm_default',
            'by_value' => true,
            'strategies' => [],
            'use_generated_hydrator' => true,
        ],
    ],
    'zf-content-validation' => [
        'Bookshop\\V1\\Rest\\Books\\Controller' => [
            'input_filter' => 'Bookshop\\V1\\Rest\\Books\\Validator',
        ],
        'Bookshop\\V1\\Rest\\Authors\\Controller' => [
            'input_filter' => 'Bookshop\\V1\\Rest\\Authors\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'Bookshop\\V1\\Rest\\Books\\Validator' => [
            0 => [
                'name' => 'releaseDate',
                'required' => false,
                'filters' => [],
                'validators' => [],
            ],
            1 => [
                'name' => 'title',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 250,
                        ],
                    ],
                ],
            ],
        ],
        'Bookshop\\V1\\Rest\\Authors\\Validator' => [
            0 => [
                'name' => 'bornDate',
                'required' => false,
                'filters' => [],
                'validators' => [],
            ],
            1 => [
                'name' => 'name',
                'required' => true,
                'filters' => [
                    0 => [
                        'name' => \Zend\Filter\StringTrim::class,
                    ],
                    1 => [
                        'name' => \Zend\Filter\StripTags::class,
                    ],
                ],
                'validators' => [
                    0 => [
                        'name' => \Zend\Validator\StringLength::class,
                        'options' => [
                            'min' => 1,
                            'max' => 50,
                        ],
                    ],
                ],
            ],
        ],
    ],
];
