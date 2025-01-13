<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <% include NSWDPC/Waratah/GTMHead %>
    <% base_tag %>
    <% include NSWDPC/Waratah/Metadata %>
    <% include NSWDPC/Waratah/Favicon %>
</head>

<body class="nsw-body-content">

<% include NSWDPC/Waratah/GTMBody %>

<% include nswds/SkipToNav %>

<% include NSWDPC/Waratah/GlobalAlert %>

<% include NSWDPC/Waratah/PageAlert %>

<% include nswds/Masthead %>

<% include nswds/Header %>

<% include NSWDPC/Waratah/MainNavigation %>

<%-- where the Top Elemental Areas live --%>
<% include NSWDPC/Waratah/PageBanner %>

<% if not $InSection(home) && not $Top.HideBreadcrumbs && $Top.Breadcrumbs %>
<% include nswds/Breadcrumbs Breadcrumbs_List=$Top.Breadcrumbs, Breadcrumbs_IncludeContainer=1 %>
<% end_if %>

{$Layout}

<% include nswds/Footer %>

<% include NSWDPC/Waratah/GlobalNotice %>

<% include NSWDPC/Waratah/BackToTop %>

</body>
</html>
