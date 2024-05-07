<% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>
<% if $HTML %>
<div class="nsw-block">
    {$HTML}
</div>
<% end_if %>
<% if $ElementLinks.Sort('Sort') %>
<div class="nsw-grid nsw-grid--spaced">
    <% loop $ElementLinks.Sort('Sort') %>
        <% include nswds/ContentBlock ContentBlock_ColumnOptions=$Up.Up.Columns, ContentBlock_Title=$Title, ContentBlock_Image=$Image, ContentBlock_IconImage=$IconImage, ContentBlock_Link=$ContentLink, ContentBlock_Listing=$Links, ContentBlock_Content=$Description %>
    <% end_loop %>
</div>
<% end_if %>
