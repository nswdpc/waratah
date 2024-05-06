<% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>
<% if $HTML %>
    {$HTML}
<% end_if %>
<% if $ElementLinks.Sort('Sort') %>
    <div class="nsw-tabs js-tabs">
        <ul class="nsw-tabs__list">
            <% loop $ElementLinks.Sort('Sort') %>
                <% include nswds/TabsTab Tab_Title=$Title, Tab_URLSegment=$Anchor %>
            <% end_loop %>
        </ul>
        <% loop $ElementLinks.Sort('Sort') %>
            <% include nswds/TabsContent Tab_Title=$Title, Tab_URLSegment=$Anchor, Tab_HTML=$HTML %>
        <% end_loop %>
    </div>
<% end_if %>
