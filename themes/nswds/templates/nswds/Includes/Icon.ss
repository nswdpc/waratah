<% if $Icon_Icon %>
    <span class="material-icons nsw-material-icons<% if $Icon_IconExtraClass %> {$Icon_IconExtraClass.XML}<% end_if %><% if $Icon_Size > 0 %> nsw-material-icons--{$Icon_Size.XML}<% end_if %>" focusable="false" aria-hidden="true">{$Icon_Icon.XML}</span>
<% else_if $Icon %>
    <%-- BC with previous unscoped_ variable (remove!) --%>
    <% include nswds/Icon Icon_Icon=$Icon, Icon_IconExtraClass=$IconExtraClass %>
<% end_if %>
