<div id="{$HolderID}" class="nsw-form__group nsw-form__date wrth-form__composite<% if $ExtraClass %> {$ExtraClass}<% end_if %>" data-is-composite="1">

    <label class="nsw-form__label<% if $Required %> nsw-form__required<% end_if %>" for="{$Children.First.ID}">{$Title.XML}</label>
    <% include NSWDPC/Waratah/Forms/Description %>

    <% if $FieldWarning %>
        <span class="nsw-form__helper nsw-form__helper--error"><% include nswds/Icon Icon_Icon='warning' %>{$FieldWarning.XML}</span>
    <% end_if %>

    <% include nswds/FormFieldMessage FormFieldMessage_IsCompact=1, FormFieldMessage_Message=$Message, FormFieldMessage_MessageType=$MessageType, FormFieldMessage_MessageCast=$MessageCast %>

    <div class="nsw-form__date-wrapper">
        {$Field}
    </div>
    <% if $FormatExample %><span class="nsw-form__helper">{$FormatExample.XML}</span><% end_if %>

    <% include NSWDPC/Waratah/Forms/RightTitle %>

</div>
