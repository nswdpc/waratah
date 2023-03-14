<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Extension;

/**
 * Provide extra methods to assist with OAuth login
 * @author James
 */
class OAuthLoginFormExtension extends Extension
{

    /**
     * Update the form actions provided by the base form, set a description and right
     * title to provide context
     * @return void
     */
    public function updateFormActions(&$actions) {
        $providers = Config::inst()->get($this->owner->getAuthenticatorClass(), 'providers');
        if(!is_array($providers)) {
            return;
        }
        foreach ($providers as $provider => $config) {
            $name = isset($config['name']) ? $config['name'] : $provider;
            $action = $actions->fieldByName('action_authenticate_'. $provider);
            if($action) {
                $action->setDescription( $name );
                $label = isset($config['label']) ? $config['label'] : '';
                if($label) {
                    $action->setRightTitle( $label );
                }
            }
        }
    }

}
