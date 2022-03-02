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

    private bool $enabled = false;

    private IntegrationHelper $integrationHelper;

    private array $settings = [];

    public function __construct(IntegrationHelper $integrationHelper)
    {
        $this->integrationHelper = $integrationHelper;
    }

    private function init(): void
    {
        if (null === $this->integration) {
            $this->integration = $this->integrationHelper->getIntegrationObject('OwnerRotator');
            if ($this->integration instanceof OwnerRotatorIntegration && $this->integration->getIntegrationSettings()->getIsPublished()) {
                $this->settings = $this->integration->mergeConfigToFeatureSettings();
                $this->enabled  = true;
            }
        }
    }

    public function isEnabled(): bool
    {
        $this->init();

        return $this->enabled;
    }

    public function getOwnerForMakeRotation(): ?int
    {
        $this->init();

        return ArrayHelper::getValue('owner', $this->settings);
    }

    public function getOwnersForRotation(): array
    {
        $this->init();

        return ArrayHelper::getValue('owners', $this->settings, []);
    }
}
