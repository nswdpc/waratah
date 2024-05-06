<% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>
<% if $HTML %>
<div class="nsw-block">
    {$HTML}
</div>
<% end_if %>
<% if $ElementLinks.Sort('Sort') %>
    <div class="nsw-grid">
        <% loop $ElementLinks.Sort('Sort') %>
            <div class="nsw-col {$Up.Up.ColumnClass($Up.OverrideColumns)}">
                {$Me}
            </div>
        <% end_loop %>
    </div>
<% end_if %>
