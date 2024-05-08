<% if $Tags_List %>
    <div class="nsw-list nsw-list--<% if $Tags_ListSize %>{$Tags_ListSize}<% else %>8<% end_if %>">
    <% loop $Tags_List %>

        <% if $Link %>
            <a class="nsw-tag" href="{$Link.LinkURL}">{$Link.Title.XML}</a>
        <% else_if $LinkURL %>
            <a class="nsw-tag" href="{$LinkURL.XML}">{$Title.XML}</a>
        <% else_if $Field %>
            <div class="nsw-tag nsw-tag--checkbox">
                {$Field}
            </div>
        <% else %>
            <span class="nsw-tag">{$Title.XML}</span>
        <% end_if %>

    <% end_loop %>
    </div>
<% else_if $TagsList %>
    <%-- BC with non-scoped variables--%>
    <% include nswds/Tags Tags_List=$TagsList %>
<% end_if %>
