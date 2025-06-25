<?php

namespace NSWDPC\Waratah\Models;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Control\Director;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBVarchar;
use SilverStripe\View\ArrayData;

/**
 * Implement NSWDS Utility List component as a content block that can be placed in pages
 * @property bool $Vertical
 * @property ?string $Features
 * @property ?string $Networks
 * @property ?string $Prompt
 * @property ?string $Body
 * @property ?string $HashTags
 */
class ElementalUtilityList extends BaseElement
{
    /**
     * @var string
     */
    public const NETWORK_LINKEDIN = 'linkedin';

    /**
     * @var string
     */
    public const NETWORK_TWITTER = 'twitter';

    /**
     * @var string
     */
    public const NETWORK_FACEBOOK = 'facebook';

    /**
     * @var string
     */
    public const NETWORK_EMAIL = 'email';

    /**
     * @var string
     */
    public const FEATURE_COPYLINK = 'copylink';

    /**
     * @var string
     */
    public const FEATURE_PRINT = 'print';

    /**
     * @var string
     */
    public const FEATURE_DOWNLOAD = 'download';

    /**
     * @var string
     */
    public const FEATURE_SHARE = 'share';

    private static bool $inline_editable = true;

    private static string $table_name = 'ElementalUtilityList';

    private static string $singular_name = 'Utility list (NSW Design System)';

    private static string $plural_name = 'Utility lists (NSW Design System)';

    private static string $description = 'Create a utility list';

    private static string $icon = 'font-icon-list';

    private static array $db = [
        'Vertical' => 'Boolean',
        'Features' => 'Text',
        'Networks' => 'Text',
        'Prompt' => 'Varchar',
        'Body' => 'Text',
        'HashTags' => 'Text'
    ];

    /**
     * @inheritdoc
     */
    #[\Override]
    public function getType()
    {
        return _t(static::class . '.BlockType', 'Utility list (NSW Design System)');
    }

    /**
     * Get supported networks
     */
    public function getSupportedNetworks(): array
    {
        $networks = [
            static::NETWORK_EMAIL => _t('nswds.EMAIL', 'Email'),
            static::NETWORK_FACEBOOK => _t('nswds.FACEBOOK', 'Facebook'),
            static::NETWORK_TWITTER => _t('nswds.TWITTER', 'Twitter (X)'),
            static::NETWORK_LINKEDIN => _t('nswds.LINKEDIN', 'LinkedIn'),
        ];
        $this->extend('updateSupportedNetworks', $networks);
        return $networks;
    }

    /**
     * Get supported features
     */
    public function getSupportedFeatures(): array
    {
        $features = [
            static::FEATURE_COPYLINK => _t('nswds.FEATURE_COPY_LINK', 'Copy link'),
            static::FEATURE_PRINT => _t('nswds.FEATURE_PRINT', 'Print this page'),
            static::FEATURE_DOWNLOAD => _t('nswds.FEATURE_DOWNLOAD', 'Download as PDF (only available if supported by this website)'),
            static::FEATURE_SHARE => _t('nswds.FEATURE_SHARE_NETWORK', 'Share this page'),
        ];
        $this->extend('updateSupportedFeatures', $features);
        return $features;
    }

    #[\Override]
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab(
            'Root.Main',
            CheckboxField::create(
                'Vertical',
                _t('nswds.UTILITY_LIST_SHOW_VERTICAL', 'Display in vertical orientation')
            )
        );

        $fields->addFieldToTab(
            'Root.Main',
            CheckboxSetField::create(
                'Features',
                _t('nswds.UTILITY_LIST_FEATURES', 'Features'),
                $this->getSupportedFeatures()
            )
        );

        $fields->addFieldToTab(
            'Root.Main',
            CheckboxSetField::create(
                'Networks',
                _t('nswds.UTILITY_LIST_NETWORKS', 'Supported networks'),
                $this->getSupportedNetworks()
            )
        );

        $fields->insertAfter(
            'Networks',
            TextField::create(
                'Prompt',
                _t('nswds.UTILITY_LIST_PROMPT', 'Prompt to user, if supported by network')
            )
        );

        $fields->insertAfter(
            'Prompt',
            TextareaField::create(
                'Body',
                _t('nswds.UTILITY_LIST_SHOW_VERTICAL', 'Description of content, if supported by network')
            )
        );

        // Hash tags are currently a comma separate list of values
        $fields->insertAfter(
            'Body',
            TextField::create(
                'HashTags',
                _t('nswds.UTILITY_LIST_HASGTAGS', 'Hash tags, if supported by network'),
            )
        );
        return $fields;
    }

    /**
     * Return array of selected hashTags
     */
    public function SelectedHashTags(): array
    {
        try {
            $hashTags = explode(",", $this->HashTags ?? '');
            if (is_array($hashTags)) {
                return array_filter(array_unique($hashTags));
            } else {
                return [];
            }
        } catch (\Exception) {
            return [];
        }
    }

    /**
     * Return string of selected hashtags, delimited and prefixed
     */
    public function SelectedHashTagsString(string $delimiter = ",", string $prefix = "#"): DBVarchar
    {
        $hashTags = $this->SelectedHashTags();
        if ($prefix !== '') {
            array_walk(
                $hashTags,
                function (&$value, $key) use ($prefix): void {
                    $value = $prefix . $value;
                }
            );
        }

        return DBField::create_field(DBVarchar::class, implode($delimiter, $hashTags));
    }

    /**
     * Return hash tags for attribute in twitter share
     */
    public function TwitterTags(): DBVarchar
    {
        return $this->SelectedHashTagsString(",", "#");
    }

    /**
     * Return feature selected as ArrayData for templates
     */
    public function SelectedFeatures(): ?ArrayData
    {
        try {
            $features = json_decode($this->Features ?? '');
            if (is_array($features)) {
                $data = ArrayData::create();
                foreach ($features as $key) {
                    $data->setField($key, true);
                }

                return $data;
            } else {
                return null;
            }
        } catch (\Exception) {
            return null;
        }
    }

    /**
     * Return networks selected as ArrayData for templates
     * Note that this is returned whether or not static::FEATURE_SHARE is selected as a feature
     */
    public function SelectedNetworks(): ?ArrayData
    {
        try {
            $networks = json_decode($this->Networks ?? '');
            if (is_array($networks)) {
                $data = ArrayData::create();
                foreach ($networks as $key) {
                    $data->setField($key, true);
                }

                return $data;
            } else {
                return null;
            }
        } catch (\Exception) {
            return null;
        }
    }

    /**
     * Returns the current URL, via Director
     */
    protected static function getCurrentPageUrl($action = null): string
    {
        $current = Director::get_current_page();
        $url = '';
        if ($current && $current->hasMethod('AbsoluteLink')) {
            $url = $current->AbsoluteLink($action);
        }

        return $url;
    }

    /**
     * Returns the current URL, as a template variable
     */
    public function CurrentPageURL($action = null): DBVarchar
    {
        return DBField::create_field(DBVarchar::class, static::getCurrentPageUrl($action));
    }

    /**
     * Returns the body with the URL
     */
    public function BodyWithURL($action = null): DBVarchar
    {
        $url = static::getCurrentPageUrl($action);
        $value = _t(
            'nswds.UTILITY_LIST_BODY_WITH_URL',
            '{body} Link: {url}',
            [
                'body' => $this->Body ?? '',
                'url' => $url
            ]
        );
        return DBField::create_field(DBVarchar::class, $value);
    }

}
