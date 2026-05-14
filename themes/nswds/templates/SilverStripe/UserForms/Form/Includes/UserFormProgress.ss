<% if $Steps.Count > 1 %>

    <div id="userform-progress" class="userform-progress nsw-progress-indicator nsw-m-bottom-md" aria-hidden="true" style="display:none;">

        <div class="nsw-progress-indicator__count">
            <%t nswds.USERFORM_STEP_PREFIX "Step" %> <span class="current-step-number">1</span> <%t nswds.USERFORM_STEP_OF_TOTAL "of" %> <span class="total-step-number">{$Steps.Count}</span>
        </div>


        <nav aria-label="<%t nswds.STEPS_IN_THIS_FORM 'Steps in this form' %>" class="progress-bar step-buttons nsw-progress-indicator__bar" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="{$Steps.Count}">

            <% loop $Steps %>
            <div class="step-button-wrapper<% if $IsFirst %> current<% end_if %>" data-for="{$Name}">
                <button class="step-button-jump" disabled="disabled" data-step="{$Pos}">
                    <span><% if $Top.ButtonText %>{$Top.ButtonText} <% end_if %>{$Pos}</span>
                </button>
            </div>
            <% end_loop %>

        </nav>

    </div>

<% end_if %>
