<% if $ShowTitle && $Title %>
    <% include nswds/Callout Callout_HTML=$HTML, Callout_Title=$Title, Callout_Link=$DerivedLinkTarget %>
<% else %>
    <% include nswds/Callout Callout_HTML=$HTML, Callout_Title='', Callout_Link=$DerivedLinkTarget %>
<% end_if %>
