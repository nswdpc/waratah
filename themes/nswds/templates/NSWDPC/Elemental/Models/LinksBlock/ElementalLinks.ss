<% if $Subtype == 'cards' %>
    <% include NSWDPC/Waratah/ElementalLinks/Cards %>
<% else_if $Subtype == 'carousel' %>
    <% include NSWDPC/Waratah/ElementalLinks/CardCarousel %>
<% else_if $Subtype == 'feature-tile' %>
    <% include NSWDPC/Waratah/ElementalLinks/FeatureTile %>
<% else_if $Subtype == 'link-list' %>
    <% include NSWDPC/Waratah/ElementalLinks/LinkList %>
<% end_if %>
