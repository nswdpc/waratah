<% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>
<% if $HTML %>
<div class="nsw-block">
    {$HTML}
</div>
<% end_if %>
<% if $Elements.Elements %>
<div class="nsw-block">
    <div class="nsw-grid">
        <% loop $Elements.Elements %>
            <div class="nsw-col {$Top.ColumnClass}">
                {$Me}
            </div>
        <% end_loop %>
    </div>
</div>
<% end_if %>
