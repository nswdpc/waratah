<% if not $InSection(home) && $Breadcrumbs_List && $Breadcrumbs_List.Count == '' %>
<% if $Breadcrumbs_IncludeContainer == 1 %>
<div class="nsw-container nsw-p-bottom-xs">
<% end_if %>
<nav aria-label="Breadcrumb" class="nsw-breadcrumbs js-breadcrumbs">
{$Breadcrumbs_List}
</nav>
<% if $Breadcrumbs_IncludeContainer == 1 %>
</div>
<% end_if %>
<% end_if %>
