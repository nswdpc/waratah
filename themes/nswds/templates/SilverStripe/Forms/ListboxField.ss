<% if $InFilterForm %>
<div class="nsw-multi-select js-multi-select" data-selection-text="<% if $SelectionText %>{$SelectionText}<% else %><%t nswds.DEFAULT_LISTBOX_SELECTION_TEXT 'items' %><% end_if %>">
<% end_if %>
    <select $AttributesHTML>
    <% loop $Options %>
        <option value="$Value.XML"<% if $Selected %> selected="selected"<% end_if %><% if $Disabled %> disabled="disabled"<% end_if %>>$Title.XML</option>
    <% end_loop %>
    </select>
<% if $InFilterForm %>
</div>
<% end_if %>
