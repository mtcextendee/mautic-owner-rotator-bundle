<?php

return [
    'name'        => 'MauticOwnerRotatorBundle',
    'description' => 'Owner rotation for Mautic',
    'version'     => '1.0.2',
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
                    'mautic.core.model.notification',
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
                    'event_dispatcher',
                    'mautic.helper.cache_storage',
                    'doctrine.orm.entity_manager',
                    'session',
                    'request_stack',
                    'router',
                    'translator',
                    'monolog.logger.mautic',
                    'mautic.helper.encryption',
                    'mautic.lead.model.lead',
                    'mautic.lead.model.company',
                    'mautic.helper.paths',
                    'mautic.core.model.notification',
                    'mautic.lead.model.field',
                    'mautic.plugin.model.integration_entity',
                    'mautic.lead.model.dnc',
                    'mautic.helper.user',
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
