<% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>
<% if $HTML %>
<div class="nsw-block">
    {$HTML}
</div>
<% end_if %>
<% if $Elements.Elements %>
<div class="nsw-block">
<div class="nsw-grid nsw-grid--spaced">
    <% loop $Elements.Elements %>
        <% include nswds/ContentBlock ContentBlock_ColumnOptions=$Top.ColumnClass, ContentBlock_Title=$Title, ContentBlock_Image=$ContentImage, ContentBlock_IconImage=$IconImage, ContentBlock_Link=$ContentLink, ContentBlock_Listing=$Links, ContentBlock_Content=$HTML %>
    <% end_loop %>
</div>
</div>
<% end_if %>
