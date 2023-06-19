<% if $ContentBlocks_Items %>
<div class="nsw-grid">
    <% loop $ContentBlocks_Items %>
        <% include nswds/ContentBlock %>
    <% end_loop %>
</div>
<% end_if %>
