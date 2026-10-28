<% if $ShowTitle && $Title %>

    <% include nswds/ContentBlock ContentBlock_NoGrid=1, ContentBlock_Title=$Title, ContentBlock_Image=$Image, ContentBlock_Link=$DerivedLinkTarget, ContentBlock_Content=$HTML %>

<% else %>

    <% include nswds/ContentBlock ContentBlock_NoGrid=1, ContentBlock_Title='', ContentBlock_Image=$Image, ContentBlock_Link=$DerivedLinkTarget, ContentBlock_Content=$HTML %>

<% end_if %>
