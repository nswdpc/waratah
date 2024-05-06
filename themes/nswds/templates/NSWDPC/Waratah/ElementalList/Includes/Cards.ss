<% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>
<% if $HTML %>
<div class="nsw-block">
    {$HTML}
</div>
<% end_if %>
<% if $Elements.Elements %>
    <div class="nsw-grid">

        <% loop $Elements.Elements %>
        <% include nswds/Card Card_ColumnOptions=$Up.Up.Columns, Card_Title=$Title, Card_LinkURL=$ContentLink.LinkURL, Card_LinkOpenInNewWindow=$ContentLink.OpenInNewWindow, Card_CardStyle=$Up.Up.CardStyle, Card_Image=$ContentImage, Card_Description=$HTML.Plain %>
        <% end_loop %>
    </div>
<% end_if %>
