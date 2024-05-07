<% if $Subtype == 'cards' %>
    <% include NSWDPC/Waratah/ElementalLinks/Cards %>
<% else_if $Subtype == 'carousel' %>
    <% include NSWDPC/Waratah/ElementalLinks/CardCarousel %>
<% else_if $Subtype == 'linklist' || $Subtype == 'link-list' %>
    <% include NSWDPC/Waratah/ElementalLinks/LinkList %>
<% else %>
    <% include NSWDPC/Waratah/ElementalLinks/CustomListing Subtype=$Subtype %>
<% end_if %>
