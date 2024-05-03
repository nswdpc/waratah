<% if $Subtype == 'none' || not $Subtype %>
    <% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>
    {$Elements}
<% else_if $Subtype == 'cards' %>
    <% include NSWDPC/Waratah/ElementalList/Cards %>
<% else_if $Subtype == 'carousel' %>
    <% include NSWDPC/Waratah/ElementalList/CardCarousel %>
<% else_if $Subtype == 'content-blocks' %>
    <% include NSWDPC/Waratah/ElementalList/ContentBlocks %>
<% else_if $Subtype == 'accordion' %>
    <% include NSWDPC/Waratah/ElementalList/Accordion %>
<% else_if $Subtype == 'tabs' %>
    <% include NSWDPC/Waratah/ElementalList/Tabs %>
<% else_if $Subtype == 'grid' %>
    <% include NSWDPC/Waratah/ElementalList/Grid %>
<% else_if $Subtype == 'listitem' %>
    <% include NSWDPC/Waratah/ElementalList/ListItems %>
<% else_if $Subtype == 'linklist' %>
    <% include NSWDPC/Waratah/ElementalList/LinkList %>
<% end_if %>
