
<%-- NOTE: this requires a JS enhancement --%>
<fieldset class="nsw-form__fieldset">

    <% include NSWDPC/Waratah/Forms/Legend %>

    <% loop $FieldSet %>
        <div class="nsw-p-left-xs nsw-p-bottom-lg">
            {$RadioButton}
            <label class="nsw-form__radio-label" for="{$Up.ID}_{$Pos}">{$RadioLabel}</label>
            <div class="nsw-form__group">
            {$Field}
            </div>
        </div>
    <% end_loop %>

</fieldset>
