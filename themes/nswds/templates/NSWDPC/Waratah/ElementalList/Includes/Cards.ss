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
        <% include nswds/Card Card_ColumnOptions=$Top.Columns, Card_Title=$Title, Card_LinkURL=$ContentLink.LinkURL, Card_LinkOpenInNewWindow=$ContentLink.OpenInNewWindow, Card_CardStyle=$Top.CardStyle, Card_Image=$ContentImage, Card_Description=$HTML.Plain %>
        <% end_loop %>
    </div>
</div>
<% end_if %>
