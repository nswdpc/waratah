<div id="$HolderID" class="nsw-form__group wrth-form__fieldgroup<% if $ParentExtraClass %> {$ParentExtraClass}<%end_if %>">

<!-- fieldgroup_defaultholder -->

<fieldset class="nsw-form__fieldset">

    <% include NSWDPC/Waratah/Forms/Legend %>

    <% include NSWDPC/Waratah/Forms/Description %>

    <% include nswds/FormFieldMessage FormFieldMessage_IsCompact=1, FormFieldMessage_Message=$Message, FormFieldMessage_MessageType=$MessageType %>

    <div class="field">
    {$Field}
    </div>

    <% include NSWDPC/Waratah/Forms/RightTitle %>

</fieldset>

</div>
