<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Extension;

/**
 * Provide extra methods to assist with OAuth login
 * @author James
 * @extends \SilverStripe\Core\Extension<static>
 */
class OAuthLoginFormExtension extends Extension
{
    /**
     * Update the form actions provided by the base form, set a description and right
     * title to provide context
     * @return void
     */
    public function updateFormActions(&$actions)
    {
        $providers = Config::inst()->get($this->getOwner()->getAuthenticatorClass(), 'providers');
        if (!is_array($providers)) {
            return;
        }

        foreach ($providers as $provider => $config) {
            $name = $config['name'] ?? $provider;
            $action = $actions->fieldByName('action_authenticate_'. $provider);
            if ($action) {
                $action->setDescription($name);
                $label = $config['label'] ?? '';
                if ($label) {
                    $action->setRightTitle($label);
                }
            }
        }
    }

}
