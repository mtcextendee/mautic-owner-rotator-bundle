<?php

return [
    'name'        => 'MauticOwnerRotatorBundle',
    'description' => 'Owner rotation for Mautic',
    'version'     => '1.0',
    'author'      => 'MTCExtendee',

    'routes' => [
    ],

    'services'   => [
        'events'       => [
            'mautic.ownerrotator.lead.subscriber' => [
                'class'     => \MauticPlugin\MauticOwnerRotatorBundle\EventListener\LeadSubscriber::class,
                'arguments' => [
                    'mautic.ownerrotator.integration.settings',
                    'mautic.user.model.user',
                    'mautic.core.model.notification'
                ],
            ],

        ],
        'forms'        => [
        ],
        'models'       => [

        ],
        'integrations' => [
            'mautic.integration.ownerrotator' => [
                'class'     => \MauticPlugin\MauticOwnerRotatorBundle\Integration\OwnerRotatorIntegration::class,
                'arguments' => [
                ],
            ],
        ],
        'others'       => [
            'mautic.ownerrotator.integration.settings' => [
                'class'     => \MauticPlugin\MauticOwnerRotatorBundle\Integration\OwnerRotatorSettings::class,
                'arguments' => [
                    'mautic.helper.integration',
                ],
            ],
        ],
        'controllers'  => [
        ],
        'commands'     => [

        ],
    ],
    'parameters' => [
    ],
];
