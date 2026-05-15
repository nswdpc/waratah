<% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>
<% if $HTML %>
<div class="nsw-block">
    {$HTML}
</div>
<% end_if %>
<% if $Elements.Elements %>
<div class="nsw-block">
    <% include nswds/Accordion Accordion_Details=1, Accordion_ID=$Anchor, Accordion_ExpandContract=1, Accordion_Items=$Elements.Elements %>
</div>
<% end_if %>
