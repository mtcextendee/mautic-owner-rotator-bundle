<?php

/*
 * @copyright   2019 MTCExtendee. All rights reserved
 * @author      MTCExtendee
 * @license     GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

namespace MauticPlugin\MauticOwnerRotatorBundle\Integration;

use Mautic\CoreBundle\Helper\ArrayHelper;
use Mautic\PluginBundle\Helper\IntegrationHelper;

class OwnerRotatorSettings
{

    /**
     * @var bool|\Mautic\PluginBundle\Integration\AbstractIntegration
     */
    private $integration;

    private $enabled = false;

    /**
     * @var array
     */
    private $settings = [];

    /**
     * DolistSettings constructor.
     *
     * @param IntegrationHelper $integrationHelper
     */
    public function __construct(IntegrationHelper $integrationHelper)
    {
        $this->integration = $integrationHelper->getIntegrationObject('OwnerRotator');
        if ($this->integration instanceof OwnerRotatorIntegration && $this->integration->getIntegrationSettings(
            )->getIsPublished()) {
            $this->settings = $this->integration->mergeConfigToFeatureSettings();
            $this->enabled = true;
        }
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @return int
     */
    public function getOwnerForMakeRotation()
    {
        return ArrayHelper::getValue('owner', $this->settings, null);
    }

    /**
     * @return array
     */
    public function getOwnersForRotation()
    {
        return ArrayHelper::getValue('owners', $this->settings, []);
    }


}
