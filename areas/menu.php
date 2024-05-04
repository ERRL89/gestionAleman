<?php

function loadMenu($area)
{
    switch ($area) {
        case 1: // ADMINISTRACIÓN 
            return $menuOptions =
                [
                    [
                        'label' => 'Clientes',
                        'favicon' => 'fas fa-users',
                        'idMenu' => 'menuClientes',
                        'submenus' => [
                            [
                                'label' => 'WallMart',
                                'favicon' => '',
                                'url' => '',
                            ],
                            [
                                'label' => 'Ingram',
                                'favicon' => '',
                                'url' => '',
                            ],
                            [
                                'label' => 'Amazon',
                                'favicon' => '',
                                'url' => '',
                            ],
                            [
                                'label' => 'Sears',
                                'favicon' => '',
                                'url' => '',
                            ],
                        ]
                    ],
                    [
                        'label' => 'Cotizaciones',
                        'favicon' => 'fa-solid fa-computer',
                        'idMenu' => 'menuDemos',
                        'submenus' => [
                            [
                                'label' => 'Nueva Cotización',
                                'favicon' => '',
                                'url' => 'newPrice.php',
                            ],
                            [
                                'label' => 'Historial de Cotizaciones',
                                'favicon' => '',
                                'url' => '',
                            ],
                        ]
                    ],
                    [
                        'label' => 'Contratos',
                        'favicon' => 'fa-solid fa-file-lines',
                        'idMenu' => 'contratos',
                        'submenus' => [
                            [
                                'label' => 'Activos',
                                'favicon' => '',
                                'url' => '',
                            ],
                            [
                                'label' => 'Cancelados',
                                'favicon' => '',
                                'url' => '',
                            ]
                        ]
                    ],
                    [
                        'label' => 'Operaciones',
                        'favicon' => 'fa-solid fa-arrows-rotate',
                        'idMenu' => 'enproceso',
                        'submenus' => [
                            [
                                'label' => 'Servicios Realizados',
                                'favicon' => '',
                                'url' => '',
                            ],
                            [
                                'label' => 'Servicios Pendientes',
                                'favicon' => '',
                                'url' => '',
                            ]
                        ]
                    ],
                    [
                        'label' => 'Carta de Presentación',
                        'blank'=> 'blank',
                        'url' => 'newPrice.php',
                        'favicon' => 'fa-solid fa-sheet-plastic',
                    ],
                ];
            break;
            return $menuOptions =
                [
                    [
                        'label' => 'Contratos',
                        'favicon' => 'fas fa-file-lines',
                        'url' => 'servicesContracts.php',
                    ],
                    [
                        'label' => 'En proceso',
                        'favicon' => 'fa-solid fa-arrows-rotate',
                        'idMenu' => 'enproceso',
                        'submenus' =>
                        [
                            [
                                'label' => 'Servicios',
                                'favicon' => '',
                                'url' => 'processServices.php',
                            ],
                        ]
                    ],
                    [
                        'label' => 'Tickets',
                        'favicon' => 'fa-solid fa-ticket',
                        'url' => 'tickets.php',
                    ],
                    [
                        'label' => 'Manual de procedimientos',
                        'favicon' => 'fa-solid fa-sheet-plastic',
                        'url' => 'manual.php',
                        'blank'=> 'blank',
                    ],
                ];
            break;
            case 20: // CONTROL DE CALIDAD 
            return $menuOptions =
                [
                    [
                        'label' => 'Contratos',
                        'favicon' => 'fa-solid fa-file-lines',
                        'idMenu' => 'contratos',
                        'submenus' => 
                        [
                            [
                                'label' => 'Productos',
                                'favicon' => '',
                                'url' => 'productsContracts.php',
                            ],
                            [
                                'label' => 'Servicios',
                                'favicon' => '',
                                'url' => 'servicesContracts.php',
                            ],
                        ]
                    ],
                    [
                        'label' => 'Manual de procedimientos',
                        'url' => 'manual.php',
                        'favicon' => 'fa-solid fa-sheet-plastic',
                        'blank'=> 'blank',
                    ],
                ];
            break;
            case 21: // CONTABILIDAD 
            return $menuOptions =
                [
                    [
                        'label' => 'Contratos',
                        'favicon' => 'fa-solid fa-file-lines',
                        'idMenu' => 'contratos',
                        'submenus' => 
                        [
                            [
                                'label' => 'Productos',
                                'favicon' => '',
                                'url' => 'productsContracts.php',
                            ],
                            [
                                'label' => 'Servicios',
                                'favicon' => '',
                                'url' => 'servicesContracts.php',
                            ],
                        ]
                    ],
                    [
                        'label' => 'Manual de procedimientos',
                        'url' => 'manual.php',
                        'favicon' => 'fa-solid fa-sheet-plastic',
                        'blank'=> 'blank',
                    ],
                ];
            break;
            case 22: // ATENCIÓN A CLIENTES
                return $menuOptions =
                    [
                        [
                            'label' => 'Clientes',
                            'favicon' => 'fas fa-users',
                            'url' => 'clients.php',
                        ],
                        [
                            'label' => 'Contratos',
                            'favicon' => 'fa-solid fa-file-lines',
                            'idMenu' => 'contratos',
                            'submenus' => 
                            [
                                [
                                    'label' => 'Productos',
                                    'favicon' => '',
                                    'url' => 'productsContracts.php',
                                ],
                                [
                                    'label' => 'Servicios',
                                    'favicon' => '',
                                    'url' => 'servicesContracts.php',
                                ],
                            ]
                        ],
                        [
                            'label' => 'En proceso',
                            'favicon' => 'fa-solid fa-arrows-rotate',
                            'idMenu' => 'enproceso',
                            'submenus' =>
                            [
                                [
                                    'label' => 'Productos',
                                    'favicon' => '',
                                    'url' => 'processProducts.php',
                                ],
                                [
                                    'label' => 'Servicios',
                                    'favicon' => '',
                                    'url' => 'processServices.php',
                                ],
                                [
                                    'label' => 'Servicios adicionales',
                                    'favicon' => '',
                                    'url' => 'processAdditionalServices.php',
                                ],
                            ]
                        ],
                        [
                            'label' => 'Tickets',
                            'favicon' => 'fa-solid fa-ticket',
                            'url' => 'tickets.php',
                        ],
                        [
                            'label' => 'Area Comercial',
                            'favicon' => 'fa-solid fa-file-invoice-dollar',
                            'idMenu' => 'comercial',
                            'submenus' =>
                            [
                                [
                                    'label' => 'Recursos Graficos',
                                    'favicon' => '',
                                    'url' => 'resourcesGraphics.php',
                                ],
                                [
                                    'label' => 'Cotizador',
                                    'favicon' => '',
                                    'url' => 'quoteMaker.php',
                                ],
                            ]
                        ],
                        [
                            'label' => 'CRM',
                            'favicon' => 'fa-solid fa-address-book',
                            'idMenu' => 'crm',
                            'submenus' =>
                            [
                                [
                                    'label' => 'Prospectos',
                                    'favicon' => '',
                                    'url' => 'crmProspects.php',
                                ],
                                [
                                    'label' => 'Tratos',
                                    'favicon' => '',
                                    'url' => 'crmTreats.php',
                                ],
                                [
                                    'label' => 'Calendario',
                                    'favicon' => '',
                                    'url' => 'crmCalendar.php',
                                ],
                            ]
                        ],
                        [
                            'label' => 'Manual de procedimientos',
                            'url' => 'manual.php',
                            'favicon' => 'fa-solid fa-sheet-plastic',
                            'blank'=> 'blank',
                        ],
                    ];
                break;
        default:
            return $menuOptions =
                [
                    [
                        'label' => 'Puesto no asignado',
                    ],
                ];
            break;
    }
}
