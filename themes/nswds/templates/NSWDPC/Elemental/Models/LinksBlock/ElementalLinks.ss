<% if $Subtype == 'cards' %>
    <% include NSWDPC/Waratah/ElementalLinks/Cards %>
<% else_if $Subtype == 'carousel' %>
    <% include NSWDPC/Waratah/ElementalLinks/CardCarousel %>
<% else_if $Subtype == 'link-list' %>
    <% include NSWDPC/Waratah/ElementalLinks/LinkList %>
<% else %>
    <% include NSWDPC/Waratah/ElementalList/CustomListing Subtype=$Subtype %>
<% end_if %>
