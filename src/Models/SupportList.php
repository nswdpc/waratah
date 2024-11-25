<?php

namespace NSWDPC\Waratah\Models;

use Bummzack\SortableFile\Forms\SortableUploadField;
use gorriecoe\Link\Models\Link;
use gorriecoe\LinkField\LinkField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\DB;
use SilverStripe\Security\Permission;
use SilverStripe\Security\PermissionProvider;
use SilverStripe\View\ArrayData;
use SilverStripe\View\TemplateGlobalProvider;

/**
 * Implement NSWDS Support List component
 */
class SupportList extends DataObject implements PermissionProvider, TemplateGlobalProvider
{

    private static string $table_name = 'WrthSupportList';

    private static array $db = [
        'Header' => 'Varchar',
        'IsPrimary' => 'Boolean'
    ];

    private static array $summary_fields = [
        'Header' => 'Header',
        'IsPrimary.Nice' => 'Primary?'
    ];

    private static array $many_many = [
        'Links' => Link::class,
        'Logos' => Image::class
    ];

    private static $many_many_extraFields = [
        'Links' => [
            'Sort' => 'Int'
        ]
    ];

    private static array $indexes = [
        'IsPrimary' => true
    ];

    private static array $owns = [
        'Logos'
    ];

    public function getTitle() {
        return $this->Header;
    }

    /**
     * Provide specific ArPage permissions
     */
    public function providePermissions()
    {
        return [
            'WRTH_GLOBAL_SUPPORT_LIST_EDITOR' => [
                'name' => _t('wrth.PERMISSION_NSWDS_GLOBAL_SUPPORT_LIST', 'Manage Support List'),
                'category' => _t('arp.PERMISSION_NSWDS', 'NSW Design System'),
                'sort' => 100
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function canView($member = null)
    {
        return $this->canEdit($member);
    }

    /**
     * @inheritdoc
     */
    public function canEdit($member = null)
    {
        return Permission::checkMember($member, 'WRTH_GLOBAL_SUPPORT_LIST_EDITOR');
    }

    /**
     * @inheritdoc
     */
    public function canDelete($member = null)
    {
        return $this->canEdit($member);
    }

    /**
     * @inheritdoc
     */
    public function canCreate($member = null, $context = [])
    {
        return $this->canEdit($member);
    }

    protected function getAllowedFileTypes(): array {
        return ['png'];
    }


    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab(
            'Root.Main',
            TextField::create(
                'Header',
                _t('wrth.SUPPORT_LIST_HEADER', 'Header text')
            )->setDescription(
                _t(
                    'wrth.SUPPORT_LIST_HEADER_DESCRIPTION',
                    'If provided, this will display above the links and logos'
                )
            )
        );

        $fields->addFieldToTab(
            'Root.Main',
            CheckboxField::create(
                'IsPrimary',
                _t('wrth.SUPPORT_LIST_IS_PRIMARY', 'Primary support list for this website')
            )
        );

        $fields->removeByName('Links');
        $fields->addFieldToTab(
            'Root.Main',
            LinkField::create(
                'Links',
                _t('wrth.SUPPORT_LIST_LINKS', 'Links'),
                $this
            )
        );

        $fileTypes = $this->getAllowedFileTypes();
        $fields->removeByName('Logos');
        $fields->insertAfter(
            'Links',
            SortableUploadField::create(
                'Logos',
                _t('wrth.SUPPORT_LIST_LOGOS', 'Logos')
            )->setFolderName('wrth/support-list/logos')
            ->setDescription(
                _t(
                    'wrth.SUPPORT_LIST_LOGOS_DESCRIPTION',
                    'Will be scaled to fit within a 160x76 pixel box. Allowed file types: {fileTypes}',
                    [
                        'fileTypes' => implode(",", $fileTypes)
                    ]
                )
            )->setAllowedExtensions($fileTypes)
        );

        return $fields;
    }

    public static function get_primary_support_list(): ?static {
        return static::get()->filter(['IsPrimary' => 1])->first();
    }

    public static function get_template_global_variables()
    {
        return [
            'PrimarySupportList' => 'get_primary_support_list'
        ];
    }

    /**
     * Render this model into a template
     */
    public function forTemplate() {
        return $this->renderWith(static::class);
    }

    /**
     * Handle when this record is made primary
     */
    public function onAfterWrite() {
        parent::onAfterWrite();
        if($this->IsPrimary == 1 && $this->isChanged('IsPrimary')) {
            DB::prepared_query("UPDATE \"WrthSupportList\" SET IsPrimary = 0 WHERE ID <> ?", [$this->ID]);
        }
    }

}
