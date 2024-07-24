<%-- Page Content: render all page content --%>
<% include NSWDPC/Waratah/PageIntro %>

<%-- allow inclusion of any static non elemental content in a project on a per-layout basis --%>
<% if $PerLayoutContentTemplate %>

    <% if not $PerLayoutContentAboveElemental %>
        <% include NSWDPC/Waratah/PageElemental %>
    <% end_if %>

    <section class="nsw-section<% if $SpacingClass %> {$SpacingClass}<% end_if %>" data-type="layoutcontent">

    <% if $Top.IsLandingPage %>
        <div class="nsw-container">
    <% end_if %>

    <% include NSWDPC/Waratah/PerLayoutContent PerLayoutContentTemplate=$PerLayoutContentTemplate %>

    <% if $Top.IsLandingPage %>
        </div>
    <% end_if %>

    </section>

    <% if $PerLayoutContentAboveElemental %>
        <% include NSWDPC/Waratah/PageElemental %>
    <% end_if %>

<% else %>
    <% include NSWDPC/Waratah/PageElemental %>
<% end_if %>

<% include NSWDPC/Waratah/PageForm %>
