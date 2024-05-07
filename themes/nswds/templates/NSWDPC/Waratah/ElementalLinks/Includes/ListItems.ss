<% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>
<% if $HTML %>
<div class="nsw-block">
    {$HTML}
</div>
<% end_if %>
<% if $ElementLinks.Sort('Sort') %>
    <div class="nsw-block">
        <% loop $ElementLinks.Sort('Sort') %>
            <% include nswds/ListItem ListItem_PrimaryLabel=$CallToAction, ListItem_Date=$PublicDate, ListItem_Title=$Title, ListItem_Abstract=$Description, ListItem_LinkURL=$Me.LinkURL, ListItem_Image=$Image, ListItem_Info=$Subtitle, ListItem_Tags=$Tags %>
        <% end_loop %>
    </div>
<% end_if %>
