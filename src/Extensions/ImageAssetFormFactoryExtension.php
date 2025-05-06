<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;

/**
 * @extends \SilverStripe\Core\Extension<(\SilverStripe\AssetAdmin\Forms\ImageFormFactory & static)>
 */
class ImageAssetFormFactoryExtension extends Extension
{
    public function updateFormFields(FieldList $fields)
    {

        $creditField = TextField::create(
            'PhotoCredit',
            _t('nswds.PHOTO_CREDIT_COPYRIGHT', 'Photo credit/copyright')
        );
        $titleField = $fields->fieldByName('Editor.Details.Title');
        if ($titleField && $titleField->isReadonly()) {
            $creditField = $creditField->performReadonlyTransformation();
        }

        $fields->insertAfter(
            'Title',
            $creditField
        );
    }
}
