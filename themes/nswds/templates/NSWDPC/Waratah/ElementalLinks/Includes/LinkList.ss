<% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>
<% if $HTML %>
<div class="nsw-block">
    {$HTML}
</div>
<% end_if %>
<% if $DerivedElementLinksList %>
<div class="nsw-block">
<% include nswds/LinkList LinkList_Items=$DerivedElementLinksList %>
</div>
<% end_if %>
