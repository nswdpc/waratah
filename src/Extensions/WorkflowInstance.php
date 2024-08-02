<?php

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\ORM\DataExtension;

/**
 * Improve performance of WorkflowInstance queries
 * TODO: PR
 * See WorkflowService::getWorkflowFor()
 * @author James
 * @method (static & \Symbiote\AdvancedWorkflow\DataObjects\WorkflowInstance) getOwner()
 */
class WorkflowInstance extends DataExtension {
    private static array $indexes = [
        'TargetID' => [
            'type' => 'index',
            'columns' => ['TargetID','TargetClass']
        ],
        'WorkflowStatus' => true
    ];
}
