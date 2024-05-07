<% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>
<% if $HTML %>
<div class="nsw-block">
    {$HTML}
</div>
<% end_if %>
<% if $ElementLinks.Sort('Sort') %>
<div class="nsw-block">
    <div class="nsw-grid">
        <% loop $ElementLinks.Sort('Sort') %>
        <% include nswds/Card Card_ColumnOptions=$Up.Up.Columns, Card_Title=$Title, Card_LinkURL=$LinkURL, Card_LinkOpenInNewWindow=$OpenInNewWindow, Card_CardStyle=$Up.Up.CardStyle, Card_Image=$Image, Card_Description=$Description %>
        <% end_loop %>
    </div>
</div.
<% end_if %>
