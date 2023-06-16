<% if $ContentBlocks_Items %>
<div class="nsw-grid nsw-grid--spaced">
    <% loop $ContentBlocks_Items %>
        <% include nswds/ContentBlock ContentBlock_ColumnOptions=$Up.ColumnClass($OverrideColumns), ContentBlock_Title=$Title, ContentBlock_Image=$ContentImage,  ContentBlock_IconImage=$IconImage, ContentBlock_Link=$ContentLink, ContentBlock_Listing=$Links,  ContentBlock_Content=$HTML %>
    <% end_loop %>
</div>
<% end_if %>
