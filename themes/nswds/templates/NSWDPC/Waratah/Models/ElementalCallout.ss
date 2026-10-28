<% if $ShowTitle %>
    <% include nswds/Callout Callout_Title=$Title, Callout_HTML=$HTML, Callout_Link=$ContentLink, Callout_Image=$Image, Callout_Pictogram=$Pictogram %>
<% else %>
    <% include nswds/Callout Callout_Title='', Callout_HTML=$HTML, Callout_Link=$ContentLink, Callout_Image=$Image, Callout_Pictogram=$Pictogram %>
<% end_if %>
