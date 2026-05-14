<% if $Popover_Content && $Popover_ElementID %>
    <button type="button" class="nsw-button nsw-button--<% if $Popover_ButtonState %>{$Popover_ButtonState}<% else %>dark-outline<% end_if %> js-popover" aria-controls="popover-{$Popover_ElementID}" data-popover-position="<% if $Popover_Position %>{$Popover_Position}<% else %>bottom<% end_if %>" data-popover-gap="<% if $Popover_Gap > 0 %>{$Popover_Gap}<% else %>10<% end_if %>"><% include nswds/Icon Icon_Icon="info" %><% if $Popover_Prompt %><span>{$Popover_Prompt}</span></button><% end_if %>
    <div id="popover-{$Popover_ElementID}" class="nsw-popover">
        {$Popover_Content}
    </div>
<% end_if %>
