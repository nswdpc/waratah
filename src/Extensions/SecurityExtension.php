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
 * @extends \SilverStripe\Core\Extension<static>
 */
class SecurityExtension extends Extension
{
    /**
     * Returns a RegistrationProvider
     * @todo allow other RegistrationProvider implementers
     * @phpstan-ignore class.notFound
     */
    public function RegistrationProvider(): ?RegistrationProvider
    {
        if (class_exists(MemberRegistrationController::class)) {
            $provider = Injector::inst()->get(MemberRegistrationController::class);
            // If the provider has a rego form, return the provider
            if ($provider->MemberProfileRegistrationForm()) {
                // @phpstan-ignore return.type
                return $provider;
            }
        }

        return null;
    }

    /**
     * Returns a ProfileProvider
     * @todo allow other ProfileProvider implementers
     * @phpstan-ignore class.notFound
     */
    public function ProfileProvider(): ?ProfileProvider
    {
        if (class_exists(MemberProfileController::class)) {
            // @phpstan-ignore return.type
            return Injector::inst()->get(MemberProfileController::class);
        }

        return null;
    }

    /**
     * Returns whether a lost password handler is available
     */
    public function LostPasswordProvider(): bool
    {
        try {
            /** @var \SilverStripe\Security\Security $controller */
            $controller = $this->getOwner();
            $authenticators = $controller->getApplicableAuthenticators(AuthenticatorInterface::RESET_PASSWORD);
            return true;
        } catch (\Exception) {
            return false;
        }
    }

    /**
     * Returns whether a change password handler is available
     */
    public function ChangePasswordProvider(): bool
    {
        try {
            /** @var \SilverStripe\Security\Security $controller */
            $controller = $this->getOwner();
            $authenticators = $controller->getApplicableAuthenticators(AuthenticatorInterface::CHANGE_PASSWORD);
            return true;
        } catch (\Exception) {
            return false;
        }
    }

    /**
     * Optout of frontend analytics implementations in this controller
     */
    public function AnalyticsOptOut(): bool
    {
        return true;
    }

}
