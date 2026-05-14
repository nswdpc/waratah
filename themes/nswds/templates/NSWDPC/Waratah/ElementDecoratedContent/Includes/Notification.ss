<% if $ShowTitle && $Title %>
    <% include nswds/InPageAlert InPageAlert_Icon='info', InPageAlert_Title=$Title, InPageAlert_Content=$HTML, InPageAlert_Cast='html' %>
<% else %>
    <% include nswds/InPageAlert InPageAlert_Icon='info', InPageAlert_Title='', InPageAlert_Content=$HTML, InPageAlert_Cast='html' %>
<% end_if %>
