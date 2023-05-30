<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="utf-8">
    <% base_tag %>
    <% include NSWDPC/Waratah/Metadata %>
    <% include NSWDPC/Waratah/Favicon %>
</head>

<body class="nsw-body-content">

<% include nswds/SkipToNav %>

<% include nswds/GlobalAlert %>

<% include nswds/Masthead %>

<% include nswds/Header %>

<% include NSWDPC/Waratah/MainNavigation %>

<% if not $InSection(home) && not $Top.HideBreadcrumbs && $Top.Breadcrumbs %>
<% include nswds/Breadcrumbs Breadcrumbs_List=$Top.Breadcrumbs, Breadcrumbs_IncludeContainer=1 %>
<% end_if %>

<% include NSWDPC/Waratah/Security/MainBody Layout=$Layout, Form=$Form, Content=$Content, Title=$Title, Message=$Message %>

<% include NSWDPC/Waratah/Security/Footer %>

</body>
</html>
