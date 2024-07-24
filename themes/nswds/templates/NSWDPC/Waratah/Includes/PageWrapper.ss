<%-- this include holds scaffolding for main and side elements --%>
<% if $Top.IsLandingPage %>

    <%-- a landing page --%>
    <div class="nsw-p-top-sm" data-page-type="1">
        <main id="main-content">
            <% include NSWDPC/Waratah/PageContent PerLayoutContentTemplate=$PerLayoutContentTemplate, PerLayoutContentAboveElemental=$PerLayoutContentAboveElemental %>
        </main>
    </div>

<% else_if $Top.HasSideElements %>

    <%-- a content page, sidebar on the right --%>
    <div class="nsw-container nsw-p-top-sm" data-page-type="3">
        <div class="nsw-layout">
            <main id="main-content" class="nsw-layout__main">
            <% include NSWDPC/Waratah/PageContent PerLayoutContentTemplate=$PerLayoutContentTemplate, PerLayoutContentAboveElemental=$PerLayoutContentAboveElemental %>
            </main>
            <aside class="nsw-layout__sidebar">
            <% include NSWDPC/Waratah/Sidebar %>
            </aside>
        </div>
    </div>

<% else %>

    <%-- default: a page with navigation, sidebar on the left --%>
    <div class="nsw-container nsw-p-top-sm" data-page-type="2">
        <div class="nsw-layout">

        <% if $SidebarNavigation(1) %>
            <% with $SidebarNavigation(1) %>
                <aside class="nsw-layout__sidebar nsw-layout__sidebar--desktop">
                    <% include NSWDPC/Waratah/SidebarNav Children=$Children, URLSegment=$URLSegment, Link=$Link, MenuTitle=$MenuTitle %>
                </aside>
            <% end_with %>
            <main id="main-content" class="nsw-layout__main">
                <% include NSWDPC/Waratah/PageContent PerLayoutContentTemplate=$PerLayoutContentTemplate, PerLayoutContentAboveElemental=$PerLayoutContentAboveElemental %>
            </main>
        <% else %>
            <main id="main-content" class="nsw-layout__main">
                <% include NSWDPC/Waratah/PageContent PerLayoutContentTemplate=$PerLayoutContentTemplate, PerLayoutContentAboveElemental=$PerLayoutContentAboveElemental %>
            </main>
            <aside class="nsw-layout__sidebar nsw-layout__sidebar--desktop"></aside>
        <% end_if %>

        </div>
    </div>

<% end_if %>

<% include NSWDPC/Waratah/LastUpdated %>
