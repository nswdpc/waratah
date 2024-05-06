<% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>
<% if $HTML %>
<div class="nsw-block">
    {$HTML}
</div>
<% end_if %>
<% if $Elements.Elements %>
    <div class="nsw-link-list">
        <ul>
        <% loop $Elements.Elements %>
            <% include nswds/LinkListItem LinkListItem_Link=$ContentLink %>
        <% end_loop %>
        </ul>
    </div>
<% end_if %>
