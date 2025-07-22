<% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>

<% if $HTML %>
<div class="nsw-block">{$HTML}</div>
<% end_if %>

<% include nswds/Media Media_Image=$Image, Media_Caption=$Subtitle, Media_ShowCaption=1 %>
