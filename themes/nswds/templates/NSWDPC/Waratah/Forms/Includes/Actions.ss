<% if $Actions %>
<div class="nsw-form__group actions">

    <fieldset class="nsw-form__fieldset">
        <% if $ChooseAction %>
        <legend>
            <span class="nsw-form__legend"><%t nswds.STEP_FORM_ACTION_LEGEND 'Choose an action to complete the form' %></span>
        </legend>
        <% end_if %>
        <div class="nsw-list nsw-list--32">
        <% loop $Actions %>
            {$Field}
        <% end_loop %>
        </div>
    </fieldset>

</div>
<% end_if %>
