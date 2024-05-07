<% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>
<% if $HTML %>
<div class="nsw-block">
    {$HTML}
</div>
<% end_if %>
<% if $Elements.Elements %>
<div class="nsw-block">
    <% loop $Elements.Elements %>
        <% if $ContentLink %>
            <% include nswds/ListItem ListItem_PrimaryLabel=$CallToAction, ListItem_Date=$PublicDate, ListItem_Title=$Title, ListItem_Abstract=$HTML.Plain, ListItem_LinkURL=$ContentLink.LinkURL, ListItem_Image=$ContentImage, ListItem_Info=$Subtitle, ListItem_Tags=$Tags %>
        <% else %>
            <% include nswds/ListItem ListItem_PrimaryLabel=$CallToAction, ListItem_Date=$PublicDate, ListItem_Title=$Title, ListItem_Abstract=$HTML.Plain, ListItem_Image=$ContentImage, ListItem_Info=$Subtitle, ListItem_Tags=$Tags %>
        <% end_if %>
    <% end_loop %>
</div>
<% end_if %>
