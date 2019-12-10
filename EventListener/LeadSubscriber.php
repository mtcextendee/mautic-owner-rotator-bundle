<?php

/*
 * @copyright   2019 Mautic Contributors. All rights reserved
 * @author      Mautic
 *
 * @link        http://mautic.org
 *
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticOwnerRotatorBundle\EventListener;

use Mautic\CoreBundle\EventListener\CommonSubscriber;
use Mautic\CoreBundle\Model\NotificationModel;
use Mautic\LeadBundle\Event\LeadEvent;
use Mautic\LeadBundle\LeadEvents;
use Mautic\UserBundle\Model\UserModel;
use MauticPlugin\MauticOwnerRotatorBundle\Integration\OwnerRotatorSettings;

class LeadSubscriber extends CommonSubscriber
{

    /**
     * @var OwnerRotatorSettings
     */
    private $ownerRotatorSettings;

    /**
     * @var UserModel
     */
    private $userModel;

    /**
     * @var NotificationModel
     */
    private $notificationModel;

    /**
     * LeadSubscriber constructor.
     *
     * @param OwnerRotatorSettings $ownerRotatorSettings
     * @param UserModel            $userModel
     * @param NotificationModel    $notificationModel
     */
    public function __construct(OwnerRotatorSettings $ownerRotatorSettings, UserModel $userModel, NotificationModel $notificationModel)
    {
        $this->ownerRotatorSettings = $ownerRotatorSettings;
        $this->userModel = $userModel;
        $this->notificationModel = $notificationModel;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            LeadEvents::LEAD_PRE_SAVE => ['onLeadPreSave', 0],
        ];
    }


    /**
     * @param LeadEvent $event
     */
    public function onLeadPreSave(LeadEvent $event)
    {
        $lead = $event->getLead();

        if ($lead->getOwner() && $lead->getOwner()->getId() == $this->ownerRotatorSettings->getOwnerForMakeRotation()) {
            $owners = $this->ownerRotatorSettings->getOwnersForRotation();
            shuffle($owners);
            $owner = reset($owners);
            if ($ownerEntity = $this->userModel->getEntity($owner)) {
                $lead->setOwner($ownerEntity);
             /*   $this->notificationModel->addNotification(
                    '',
                    'info',
                    false,
                    $this->translator->trans(
                        'mautic.ownerrotator.owner.assign',
                        [
                            '%owner%' => $ownerEntity->getName().' '.$ownerEntity->getLastName(),
                            '%contact%' => '<a href="'.$this->router->generate(
                                    'mautic_contact_action',
                                    ['objectAction' => 'view', 'objectId' => $lead->getId()]
                                ).'" data-toggle="ajax">'.$lead->getPrimaryIdentifier().'</a>',
                        ]
                    ),
                    null,
                    null,
                    $lead && $lead->getOwner() ? $lead->getOwner() : $this->userModel->getSystemAdministrator()
                );*/
            }
        }

    }

}
