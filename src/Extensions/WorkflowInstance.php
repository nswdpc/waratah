<?php

declare(strict_types=1);

namespace NSWDPC\Waratah\Extensions;

use SilverStripe\Core\Extension;

/**
 * Improve performance of WorkflowInstance queries
 * TODO: PR
 * See WorkflowService::getWorkflowFor()
 * @author James
 * @extends \SilverStripe\Core\Extension<(static & \Symbiote\AdvancedWorkflow\DataObjects\WorkflowInstance)>
 */
class WorkflowInstance extends Extension
{
    private static array $indexes = [
        'TargetID' => [
            'type' => 'index',
            'columns' => ['TargetID','TargetClass']
        ],
        'WorkflowStatus' => true
    ];
}
