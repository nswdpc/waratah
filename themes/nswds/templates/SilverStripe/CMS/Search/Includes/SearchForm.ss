<% if $SearchFormContext == 'nsw-header-search' %>

    <% include NSWDPC/Waratah/GlobalSearch %>

<% else_if $SearchFormContext == 'wrth-simple-search' %>

    <% include NSWDPC/Waratah/SimpleSearch %>

<% else %>

    <%-- filter form (e.g SearchFormContext='wrth-advanced-search') --%>
    <% include NSWDPC/Waratah/AdvancedSearch %>

<% end_if %>
