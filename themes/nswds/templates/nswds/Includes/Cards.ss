<% if $Cards_Items %>
<div class="nsw-grid">
    <% loop $Cards_Items %>
        <%-- some values come from the parent context --%>
        <% include nswds/Card Card_ColumnOptions=$Up.ColumnOptions, Card_HeadlineOnly=$Up.Card_HeadlineOnly, Card_Highlight=$Up.Card_Highlight, Card_Horizontal=$Up.Card_Horizontal %>
    <% end_loop %>
</div>
<% end_if %>
