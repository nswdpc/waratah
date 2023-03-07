<% if $FormFieldMessage_Message %>
    <% if $FormFieldMessage_MessageType == 'bad' || $FormFieldMessage_MessageType == 'error' || $FormFieldMessage_MessageType == 'required' || $FormFieldMessage_MessageType == 'validation' %>
        <% include nswds/FormFieldNotification FormFieldNotification_IsCompact=$FormFieldMessage_IsCompact, FormFieldNotification_Icon='cancel', FormFieldNotification_Level='error', FormFieldNotification_MessageTitle='Error', FormFieldNotification_Message=$FormFieldMessage_Message, FormFieldNotification_MessageCast=$FormFieldMessage_MessageCast %>
    <% else %>
        <% include nswds/FormFieldNotification FormFieldNotification_IsCompact=$FormFieldMessage_IsCompact, FormFieldNotification_Icon='check_circle', FormFieldNotification_Level='valid', FormFieldNotification_MessageTitle='Information', FormFieldNotification_Message=$FormFieldMessage_Message, FormFieldNotification_MessageCast=$FormFieldMessage_MessageCast %>
    <% end_if %>
<% end_if %>
