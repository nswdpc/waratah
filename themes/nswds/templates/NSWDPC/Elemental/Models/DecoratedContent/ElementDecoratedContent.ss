<% if $Subtype == 'none' || not $Subtype %>
    <% include NSWDPC/Waratah/ElementDecoratedContent/Default %>
<% else_if $Subtype == 'callout' %>
    <% include NSWDPC/Waratah/ElementDecoratedContent/Callout %>
<% else_if $Subtype == 'profile' %>
    <% include NSWDPC/Waratah/ElementDecoratedContent/Profile %>
<% else_if $Subtype == 'card' %>
    <% include NSWDPC/Waratah/ElementDecoratedContent/Card %>
<% else_if $Subtype == 'contentblock' %>
    <% include NSWDPC/Waratah/ElementDecoratedContent/ContentBlock %>
<% else_if $Subtype == 'media-image' %>
    <% include NSWDPC/Waratah/ElementDecoratedContent/MediaImage %>
<% else_if $Subtype == 'media-video' %>
    <% include NSWDPC/Waratah/ElementDecoratedContent/MediaVideo %>
<% else_if $Subtype == 'global-alert' %>
    <% include NSWDPC/Waratah/ElementDecoratedContent/GlobalAlert %>
<% else_if $Subtype == 'notification' %>
    <% include NSWDPC/Waratah/ElementDecoratedContent/Notification %>
<% end_if %>
