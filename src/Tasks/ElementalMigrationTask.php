<?php

namespace NSWDPC\Waratah\Tasks;

use SilverStripe\Dev\BuildTask;
use SilverStripe\ORM\DB;
use SilverStripe\Core\Convert;
use DNADesign\Elemental\Models\BaseElement;

/**
 * @author James
 * @author Mark
 * Perform migration/update on Elemental model based
 */
class ElementalMigrationTask extends BuildTask
{

    protected $title = 'Perform Elemental Migration task(s)';

    private static string $segment = "ElementalMigrationTask";

    private $task = '';

    private bool $publish = false;

    private bool $commit = false;

    public function run($request): ?bool
    {
        $this->task = $request->getVar('task');
        $this->publish = $request->getVar('publish') == 1;
        $this->commit = $request->getVar('commit') == 1;

        if($this->commit) {
            DB::alteration_message("Commit changes is on", "changed");
        } else {
            DB::alteration_message("Commit changes is off, pass commit=1 as an argument when ready", "changed");
        }

        if($this->publish) {
            DB::alteration_message("Update live stage changes is on, where applicable", "changed");
        } else {
            DB::alteration_message("Update live stage changes is off, pass publish=1 as an argument when ready", "changed");
        }

        if(empty($this->task)) {
            DB::alteration_message("No task provided - provide a task=taskname arg", "error");
            $this->dumpMethods();
            return false;
        }

        $upgradeMethod = 'upgrade_' . $this->task;


        if(method_exists($this, $upgradeMethod)) {
            $this->{$upgradeMethod}();
        } else {
            DB::alteration_message(sprintf('Task method %s does not exist', $this->task), "error");
            $this->dumpMethods();
            return false;
        }
        return null;
    }

    private function dumpMethods(): void {
        $methods = get_class_methods($this);
        foreach($methods as $method) {
            if(str_starts_with($method, "upgrade_")) {
                $taskMethod = preg_replace("/^upgrade_/", "", $method);
                DB::alteration_message(sprintf('Upgrade method \'%s\' is available, review the code comments', $taskMethod));
            }
        }
    }

    /**
     * Migrates background from v2 to v3 settings including handling deprecated and unsupported values
      */
    protected function upgrade_ElementalBackgroundMigration() {

        DB::alteration_message("Start transaction", "changed");
        DB::get_conn()->transactionStart();

        // from -> to
        $migrations = [
            '1' => 'off-white',
            'light-10' => 'off-white',
            'light-20' => 'grey-04',
            'light-40' => 'grey-03',
        ];

        // v3
        $currentOptions = [
            'brand-dark',
            'brand-light',
            'brand-supplementary',
            'black',
            'white',
            'off-white',
            'grey-01',
            'grey-02',
            'grey-03',
            'grey-04',
        ];

        foreach($migrations as $fromBackground => $toBackground) {
            $sqlUpdate = "UPDATE `Element` SET AddBackground = '" . Convert::raw2sql($toBackground) . "' WHERE AddBackground = '" . Convert::raw2sql($fromBackground) . "'";
            DB::alteration_message(sprintf('AddBackground change from %s to %s on Draft stage', $fromBackground, $toBackground), "changed");
            DB::query($sqlUpdate);
            DB::alteration_message("Rows changed: " . DB::affected_rows(), "changed");

            if($this->publish) {
                $sqlUpdate = "UPDATE `Element_Live` SET AddBackground = '" . Convert::raw2sql($toBackground) . "' WHERE AddBackground = '" . Convert::raw2sql($fromBackground) . "'";
                DB::alteration_message(sprintf('AddBackground change from %s to %s on Live stage', $fromBackground, $toBackground), "changed");
                DB::query($sqlUpdate);
                DB::alteration_message("Rows changed: " . DB::affected_rows(), "changed");
            }
        }

        // Special case for 0 => NULL
        $sqlUpdate = "UPDATE `Element` SET AddBackground = NULL WHERE AddBackground = '0'";
        DB::alteration_message("AddBackground change from 0 to NULL on Draft stage", "changed");
        DB::query($sqlUpdate);
        DB::alteration_message("Rows: " . DB::affected_rows(), "changed");

        if($this->publish) {
            $sqlUpdate = "UPDATE `Element_Live` SET AddBackground = NULL WHERE AddBackground = '0'";
            DB::alteration_message("AddBackground change from 0 to NULL on Live stage", "changed");
            DB::query($sqlUpdate);
            DB::alteration_message("Rows changed: " . DB::affected_rows(), "changed");
        }

        // Update any edge cases not supported to be no background (NULL)
        $sqlUpdate = 'UPDATE `Element`  SET AddBackground = NULL  WHERE AddBackground NOT IN (\''
            . implode("','", Convert::raw2sql($currentOptions))
            . "')";
        DB::alteration_message("AddBackground change from unsupported option to NULL on Draft stage", "changed");
        DB::query($sqlUpdate);
        DB::alteration_message("Rows changed: " . DB::affected_rows(), "changed");

        if($this->publish) {
            $sqlUpdate = 'UPDATE `Element_Live`  SET AddBackground = NULL  WHERE AddBackground NOT IN (\''
                . implode("','", Convert::raw2sql($currentOptions))
                . "')";
            DB::alteration_message("AddBackground change from unsupported option to NULL on Live stage", "changed");
            DB::query($sqlUpdate);
            DB::alteration_message("Rows changed: " . DB::affected_rows(), "changed");
        }

        // END

        if($this->commit) {
            DB::alteration_message("Commit", "changed");
            DB::get_conn()->transactionEnd();
        } else {
            DB::alteration_message("Rolling back", "changed");
            DB::get_conn()->transactionRollback();
        }

    }

    /**
     * Fixes default half-padding issue, note that this will rewrite all valid half-padding elements to default padding (null)
      */
    protected function upgrade_ElementalVerticalSpacing() {

        DB::alteration_message("Start transaction", "changed");
        DB::get_conn()->transactionStart();


        $sqlUpdate = "UPDATE `Element` SET VerticalSpacing = NULL WHERE VerticalSpacing = 'half-padding'";
        DB::alteration_message("VerticalSpacing changed from half-padding to NULL on Draft stage", "changed");
        DB::query($sqlUpdate);
        DB::alteration_message("Rows changed: " . DB::affected_rows(), "changed");

        if($this->publish) {
            $sqlUpdate = "UPDATE `Element_Live` SET VerticalSpacing = NULL WHERE VerticalSpacing = 'half-padding'";
            DB::alteration_message("VerticalSpacing changed from half-padding to NULL on Live stage", "changed");
            DB::query($sqlUpdate);
            DB::alteration_message("Rows changed: " . DB::affected_rows(), "changed");
        }

        // END

        if($this->commit) {
            DB::alteration_message("Commit", "changed");
            DB::get_conn()->transactionEnd();
        } else {
            DB::alteration_message("Rolling back", "changed");
            DB::get_conn()->transactionRollback();
        }

    }

}
