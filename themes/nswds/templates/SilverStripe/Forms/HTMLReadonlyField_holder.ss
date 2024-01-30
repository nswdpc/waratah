<div id="{$HolderID}" class="nsw-form__group<% if $ParentExtraClass %> {$ParentExtraClass}<%end_if %>">
<% if $FormFieldHint == 'callout' %>
    <%-- render as callout --%>
    <div class="nsw-callout">
        <div class="nsw-callout__content">
            <% if $Title %>
            <p class="nsw-h4">{$Title.XML}</p>
            <% end_if %>
            {$Value}
        </div>
    </div>
<% else_if $FormFieldHint == 'inpagealert' %>
    <%-- render as in-page-alert --%>
    <div class="nsw-in-page-alert nsw-in-page-alert--info nsw-in-page-alert--compact">
        <% if $FormFieldHintIcon %>
            <% include nswds/Icon Icon_Icon=$FormFieldHintIcon, Icon_IconExtraClass='nsw-in-page-alert__icon' %>
        <% else %>
            <% include nswds/Icon Icon_Icon='info', Icon_IconExtraClass='nsw-in-page-alert__icon' %>
        <% end_if %>
        <div class="nsw-in-page-alert__content">
            <% if $Title %>
            <p class="nsw-h5">{$Title.XML}</p>
            <% end_if %>
            {$Value}
        </div>
    </div>
<% else %>
    {$Field}
<% end_if %>
</div>
