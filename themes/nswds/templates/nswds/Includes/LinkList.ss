<% if $LinkList_Items %>
    <div class="nsw-link-list">
        <ul>
            <% loop $LinkList_Items %>
                <% include nswds/LinkListItem LinkListItem_Link=$Me %>
            <% end_loop %>
        </ul>
    </div>
<% end_if %>
