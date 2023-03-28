<?php

namespace NSWDPC\Waratah\Services;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\Form;

/**
 * When creating a custom Form, apply this trait
 * the nswds them will apply the appropriate classes
 * See also {@link NSWDPC\Waratah\FilterFormExtension}
 * @author James
 */
trait FilterFormTrait {

    /**
     * @var int|null
     */
    public $filterFormResultCount = null;

    /**
     * @var bool
     */
    public $isFilterForm = true;

    /**
     * @var bool
     */
    public $isInstant = false;

    /**
     * @var string
     * '', 'down', 'right'
     */
    public $panelDisplay = '';

    /**
     * @var bool
     */
    public $filtersCollapsed = false;

    /**
     * @var string
     */
    public function getTemplate()
    {
        return 'nswds/FilterForm';
    }

    /**
     * Return the form this trait is applied to
     * @return Form
     */
    protected function getExtendedForm() : Form {
        return $this;
    }

    /**
     * Allow runtime overriding of isFilterForm
     * @param bool
     */
    public function setIsFilterForm(bool $is) : Form {
        $this->getExtendedForm()->isFilterForm = $is;
        return $this->getExtendedForm();
    }

    /**
     * @return bool
     */
    public function IsFilterForm() : bool {
        return $this->getExtendedForm()->isFilterForm;
    }

    /**
     * A filter form can have results if it has a result count of zero or more
     * Zero results can signify a filtering result
     */
    public function HasFilterResults($arg = '') : bool {
        $resultCount = $this->getExtendedForm()->filterFormResultCount;
        $has = is_int($resultCount) && $resultCount >= 0;
        return $has;
    }

    /**
     * Set the result count,
     */
    public function FilterFormResultCount() : ?int {
        $result = $this->getExtendedForm()->filterFormResultCount;
        return $result;
    }

    /**
     * Set the result count,
     */
    public function setFilterFormResultCount(int $resultCount) : Form {
        if($resultCount < 0) {
            $resultCount = 0;
        }
        $this->getExtendedForm()->filterFormResultCount = $resultCount;
        return $this->getExtendedForm();
    }

    /**
     * Set whether this form is an 'instant' filter form
     */
    public function setIsInstant(bool $is = false) : Form {
        $this->getExtendedForm()->isInstant = $is;
        return $this->getExtendedForm();
    }

    /**
     * Get whether this form is an 'instant' filter form
     */
    public function IsInstant() : bool {
        return $this->getExtendedForm()->isInstant;
    }

    /**
     * Set panel display option
     * @param string $display on of empty string, 'down', or 'right'
     */
    public function setPanelDisplay(string $display) : Form {
        $this->getExtendedForm()->panelDisplay = $display;
        return $this->getExtendedForm();
    }

    /**
     * Return panel display value
     */
    public function PanelDisplay() : string {
        return $this->getExtendedForm()->panelDisplay;
    }

    /**
     * Set filters collapsed option
     * @param bool
     */
    public function setFiltersCollapsed(bool $collapsed) : Form {
        $this->getExtendedForm()->filtersCollapsed = $collapsed;
        return $this->getExtendedForm();
    }

    /**
     * Return filters collapsed value
     */
    public function FiltersCollapsed() : bool {
        return $this->getExtendedForm()->filtersCollapsed;
    }


    /**
     * Return the default filter results string, override in implementing forms
     */
    public function FilterResultsString() : string {
        return _t('nswds.FILTER_RESULTS', 'Filter results');
    }

    /**
     * Return the default filter results title, override in implementing forms
     */
    final public function FilterResultsTitle() : string {
        if($this->HasFilterResults()) {
            return _t(
                'nswds.FILTER_RESULTS_WITH_COUNT',
                '{filterResultsString} ({filterResultsCount}',
                [
                    'filterResultsString' => $this->FilterResultsString(),
                    'filterResultsCount' => $this->FilterFormResultCount()
                ]
            );
        } else {
            return _t(
                'nswds.FILTER_RESULTS_EMPTY',
                '{filterResultsString}',
                [
                    'filterResultsString' => $this->FilterResultsString()
                ]
            );
        }
    }

    /**
     * Add filters to form extra classes
     *
     * @return string
     */
    public function extraClass()
    {
        $panelDisplay = $this->PanelDisplay();
        if($this instanceof Form) {
            // gather any parent classes
            $extraClass = parent::extraClass();
            $extraClasses = explode(' ', $extraClass);
            $extraClasses = array_filter($extraClasses);
        } else {
            $extraClasses = [];
        }
        $extraClasses[] = 'nsw-filters';
        if($this->IsInstant()) {
            $extraClasses[] = 'nsw-filters--instant';
            if($panelDisplay == 'down') {
                $extraClasses[] = 'nsw-filters--down';
                // down requires js-filters
                $extraClasses[] = 'js-filters';
            }
            if($this->FiltersCollapsed()) {
                // collapsed filters requires js-filters
                $extraClasses[] = 'js-filters';
            }
        } else {
            // $extraClasses[] = 'nsw-filters--fixed';
            $extraClasses[] = 'js-filters';
            if($panelDisplay == 'right') {
                $extraClasses[] = 'nsw-filters--right';
            } else {
                // batch mode default option is 'down'
                $extraClasses[] = 'nsw-filters--down';
            }
        }
        return implode(' ', array_unique($extraClasses));
    }

}
