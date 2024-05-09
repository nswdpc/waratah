<% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>
<% if $HTML %>
    {$HTML}
<% end_if %>
<% if $Elements.Elements %>
<div class="nsw-block">
    <div class="nsw-tabs js-tabs">
        <ul class="nsw-tabs__list">
            <% loop $Elements.Elements %>
                <% include nswds/TabsTab Tab_Title=$Title, Tab_URLSegment=$Anchor %>
            <% end_loop %>
        </ul>
        <% loop $Elements.Elements %>
            <% include nswds/TabsContent Tab_Title=$Title, Tab_URLSegment=$Anchor, Tab_HTML=$HTML %>
        <% end_loop %>
    </div>
</div>
<% end_if %>
