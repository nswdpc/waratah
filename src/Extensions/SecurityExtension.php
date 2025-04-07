<?php

namespace NSWDPC\Waratah\Extensions;

use NSWDPC\Members\MemberRegistrationController;
use NSWDPC\Members\MemberProfileController;
use NSWDPC\Members\ProfileProvider;
use NSWDPC\Members\RegistrationProvider;
use SilverStripe\Core\Extension;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Security\Authenticator as AuthenticatorInterface;

/**
 * Provides Security helpers, such as returning providers to help with linking
 * from a custom Security template
 * @author James
 */
class SecurityExtension extends Extension
{
    /**
     * Returns a RegistrationProvider
     * @todo allow other RegistrationProvider implementers
     */
    public function RegistrationProvider(): ?RegistrationProvider
    {
        if (class_exists(MemberRegistrationController::class)) {
            $provider = Injector::inst()->get(MemberRegistrationController::class);
            // If the provider has a rego form, return the provider
            if ($provider->MemberProfileRegistrationForm()) {
                return $provider;
            }
        }
        return null;
    }

    /**
     * Returns a ProfileProvider
     * @todo allow other ProfileProvider implementers
     */
    public function ProfileProvider(): ?ProfileProvider
    {
        if (class_exists(MemberProfileController::class)) {
            return Injector::inst()->get(MemberProfileController::class);
        }
        return null;
    }

    /**
     * Returns whether a lost password handler is available
     * @return bool
     */
    public function LostPasswordProvider(): bool
    {
        try {
            $authenticators = $this->owner->getApplicableAuthenticators(AuthenticatorInterface::RESET_PASSWORD);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Returns whether a change password handler is available
     * @return bool
     */
    public function ChangePasswordProvider(): bool
    {
        try {
            $authenticators = $this->owner->getApplicableAuthenticators(AuthenticatorInterface::CHANGE_PASSWORD);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Optout of frontend analytics implementations in this controller
     * @return bool
     */
    public function AnalyticsOptOut(): bool
    {
        return true;
    }

}
