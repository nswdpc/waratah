<div class="nsw-form__helper nsw-form__helper--<% if $FormFieldNotification_Level %>{$FormFieldNotification_Level}<% else %>error<% end_if %>"<% if $FormFieldNotification_Message == '' %> style="display: none;"<% end_if %>>
    <% if $FormFieldNotification_Icon %>
        <% include nswds/Icon Icon_Icon=$FormFieldNotification_Icon , Icon_IconExtraClass='nsw-form__helper__icon' %>
    <% else_if $FormFieldNotification_Level == 'error' %>
        <% include nswds/Icon Icon_Icon='cancel', Icon_IconExtraClass='nsw-form__helper__icon' %>
    <% else %>
        <% include nswds/Icon Icon_Icon='info', Icon_IconExtraClass='nsw-form__helper__icon' %>
    <% end_if %>
    {$FormFieldNotification_Message}
</div>
