<div class="nsw-progress-indicator">

    <% if $ProgressIndicator_UseProgressElement %>

        <% if $ProgressIndicator_Total %>
            <progress max="{$ProgressIndicator_Total.XML}" value="{$ProgressIndicator_Step.XML}">
                <%t nswds.PROGRESS_STEP 'Step {step} of {total}' step=$ProgressIndicator_Step total=$ProgressIndicator_Total %>
            </progress>
        <% else %>
            <%-- deprecated --%>
            <progress max="{$Total.XML}" value="{$Step.XML}">
                <%t nswds.PROGRESS_STEP 'Step {step} of {total}' step=$Step total=$Total %>
            </progress>
        <% end_if %>

    <% else_if $ProgressIndicator_Items %>

        <% if $ProgressIndicator_Total %>
            <div class="nsw-progress-indicator__count">
                <%t nswds.PROGRESS_STEP 'Step {step} of {total}' step=$ProgressIndicator_Step total=$ProgressIndicator_Total %>
            </div>
        <% else %>
            <%-- deprecated --%>
            <div class="nsw-progress-indicator__count">
                <%t nswds.PROGRESS_STEP 'Step {step} of {total}' step=$Step total=$Total %>
            </div>
        <% end_if %>

        <div class="nsw-progress-indicator__bar">
            <% loop $ProgressIndicator_Items %>
            <div<% if $Pos <= $Up.ProgressIndicator_Step %> class="active"<% end_if %>></div>
            <% end_loop %>
        </div>

    <% end_if %>

</div>
