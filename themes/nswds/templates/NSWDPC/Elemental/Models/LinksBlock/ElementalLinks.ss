<% if $Subtype == 'cards' %>
    <% include NSWDPC/Waratah/ElementalLinks/Cards %>
<% else_if $Subtype == 'carousel' %>
    <% include NSWDPC/Waratah/ElementalLinks/CardCarousel %>
<% else_if $Subtype == 'content-blocks' %>
    <% include NSWDPC/Waratah/ElementalLinks/ContentBlocks %>
<% else_if $Subtype == 'accordion' %>
    <% include NSWDPC/Waratah/ElementalLinks/Accordion %>
<% else_if $Subtype == 'tabs' %>
    <% include NSWDPC/Waratah/ElementalLinks/Tabs %>
<% else_if $Subtype == 'grid' %>
    <% include NSWDPC/Waratah/ElementalLinks/Grid %>
<% else_if $Subtype == 'listitem' %>
    <% include NSWDPC/Waratah/ElementalLinks/ListItems %>
<% else_if $Subtype == 'linklist' || $Subtype == 'link-list' %>
    <% include NSWDPC/Waratah/ElementalLinks/LinkList %>
<% else %>
    <% include NSWDPC/Waratah/ElementalLinks/CustomListing Subtype=$Subtype %>
<% end_if %>
