<?php

use SilverStripe\Forms\HTMLEditor\TinyMCEConfig;

try {

    TinyMCEConfig::get('cms')->setOption('table_class_list', [
        [
            'title' => 'Table',
            'value' => 'nsw-table'
        ],
        [
            'title' => 'Striped',
            'value' => 'nsw-table nsw-table--striped'
        ],
        [
            'title' => 'Bordered',
            'value' => 'nsw-table nsw-table--bordered'
        ],
        [
            'title' => 'Stripe and bordered',
            'value' => 'nsw-table nsw-table--striped nsw-table--bordered'
        ]
    ]);


    TinyMCEConfig::get('cms')->setOptions([
        'importcss_append' => true,
        'style_formats' => [
            [
                'title' => 'Text',
                'items' => [
                    [
                        'title' => 'Paragraph',
                        'block' => 'p',
                        'attributes' => [
                            'class' => ''
                        ]
                    ],
                    [
                        'title' => 'Heading 1',
                        'block' => 'h1',
                        'attributes' => [
                            'class' => ''
                        ]
                    ],
                    [
                        'title' => 'Heading 2',
                        'block' => 'h2',
                        'attributes' => [
                            'class' => ''
                        ]
                    ],
                    [
                        'title' => 'Heading 3',
                        'block' => 'h3',
                        'attributes' => [
                            'class' => ''
                        ]
                    ],
                    [
                        'title' => 'Heading 4',
                        'block' => 'h4',
                        'attributes' => [
                            'class' => ''
                        ]
                    ],
                    [
                        'title' => 'Heading 5',
                        'block' => 'h5',
                        'attributes' => [
                            'class' => ''
                        ]
                    ],
                    [
                        'title' => 'Heading 6',
                        'block' => 'h6',
                        'attributes' => [
                            'class' => ''
                        ]
                    ],
                    [
                        'title' => 'Paragraph (Intro)',
                        'selector' => 'p',
                        'attributes' => [
                            'class' => 'nsw-intro'
                        ]
                    ],
                ]
            ],
            [
                'title' => 'Buttons',
                'items' => [
                    [
                        'title' => 'Dark button',
                        'selector' => 'a',
                        'attributes' => [
                            'class' => 'nsw-button nsw-button--dark'
                        ]
                    ],
                    /*
                    [
                        'title' => 'Dark Outline button',
                        'selector' => 'a',
                        'attributes' => [
                            'class' => 'nsw-button nsw-button--dark-outline'
                        ]
                    ],
                    [
                        'title' => 'Dark Outline Solid button',
                        'selector' => 'a',
                        'attributes' => [
                            'class' => 'nsw-button nsw-button--dark-outline-solid'
                        ]
                    ],
                    */
                    [
                        'title' => 'Light button',
                        'selector' => 'a',
                        'attributes' => [
                            'class' => 'nsw-button nsw-button--light'
                        ]
                    ],
                    /*
                    [
                        'title' => 'Light Outline button',
                        'selector' => 'a',
                        'attributes' => [
                            'class' => 'nsw-button nsw-button--light-outline'
                        ]
                    ],
                    [
                        'title' => 'White button',
                        'selector' => 'a',
                        'attributes' => [
                            'class' => 'nsw-button nsw-button--white'
                        ]
                    ],
                    [
                        'title' => 'White Outline button',
                        'selector' => 'a',
                        'attributes' => [
                            'class' => 'nsw-button nsw-button--white-outline'
                        ]
                    ],
                    */
                    [
                        'title' => 'Danger button',
                        'selector' => 'a',
                        'attributes' => [
                            'class' => 'nsw-button nsw-button--danger'
                        ]
                    ]
                ],
            ]
        ]
    ]);


} catch (\Exception $exception) {}