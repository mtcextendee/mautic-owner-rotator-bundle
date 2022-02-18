<?php

/*
 * @copyright   2019 MTCExtendee. All rights reserved
 * @author      MTCExtendee
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticOwnerRotatorBundle\Integration;

use Mautic\PluginBundle\Integration\AbstractIntegration;
use Mautic\UserBundle\Form\Type\UserListType;
use Symfony\Component\Form\FormBuilder;


class OwnerRotatorIntegration extends AbstractIntegration
{
    const INTEGRATION_NAME = 'OwnerRotator';

    public function getName()
    {
        return self::INTEGRATION_NAME;
    }

    public function getDisplayName()
    {
        return 'Owner Rotator';
    }

    public function getAuthenticationType()
    {
        return 'none';
    }

    public function getRequiredKeyFields()
    {
        return [
        ];
    }

    public function getIcon()
    {
        return 'plugins/MauticOwnerRotatorBundle/Assets/img/icon.png';
    }

    /**
     * @param \Mautic\PluginBundle\Integration\Form|FormBuilder $builder
     * @param array                                             $data
     * @param string                                            $formArea
     */
    public function appendToForm(&$builder, $data, $formArea)
    {
        if ($formArea == 'features') {
            $builder->add(
                'owner',
                UserListType::class,
                [
                    'label'      => 'mautic.ownerrotator.form.from.owner',
                    'label_attr' => ['class' => 'control-label'],
                    'attr'       => [
                        'class' => 'form-control',
                    ],
                    'required' => false,
                    'multiple' => false,
                ]
            );

            $builder->add(
                'owners',
                UserListType::class,
                [
                    'label'      => 'mautic.ownerrotator.form.to.owners',
                    'label_attr' => ['class' => 'control-label'],
                    'attr'       => [
                        'class' => 'form-control',
                    ],
                    'required' => false,
                    'multiple' => true,
                ]
            );
        }
    }
}
