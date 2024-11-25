<div class="nsw-support-list__gov-departments__labels">
    <% loop $SupportList_Labels %>
        <a href="{$LinkURL}"<% if $OpenInNewWindow %> target="blank"<% end_if %>>{$Title}</a>
    <% end_loop %>
</div>
