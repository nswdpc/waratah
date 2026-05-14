<% if $ShowTitle && $Title %>
    <% include nswds/InPageAlert InPageAlert_Level='warning', InPageAlert_Icon='error', InPageAlert_Title=$Title, InPageAlert_Content=$HTML, InPageAlert_Cast='html' %>
<% else %>
    <% include nswds/InPageAlert InPageAlert_Level='warning', InPageAlert_Icon='error', InPageAlert_Title='', InPageAlert_Content=$HTML, InPageAlert_Cast='html' %>
<% end_if %>
