<% if $SideNavigation_SideNavItems.Count > 0 %>
<nav class="nsw-side-nav js-side-nav" aria-labelledby="<% if $SideNavigation_SideNavLabel %>{$SideNavigation_SideNavLabel.HTMLATT}<% else %>sidenav<% end_if %>">
    <% if $SideNavigation_SideNavHeader %>
    <button class="nsw-side-nav__toggle" aria-expanded="false">
        <span>{$SideNavigation_SideNavHeader.XML}</span>
    </button>
    <div class="nsw-side-nav__header" id="<% if $SideNavigation_SideNavLabel %>{$SideNavigation_SideNavLabel.HTMLATT}<% else %>sidenav<% end_if %>">
        <% if $SideNavigation_SideNavLink %>
        <a href="{$SideNavigation_SideNavLink.XML}">{$SideNavigation_SideNavHeader.XML}</a>
        <% else %>
        <span>{$SideNavigation_SideNavHeader.XML}</span>
        <% end_if %>
    </div>
    <% end_if %>
    <% include nswds/SideNavigation_Children SideNavigation_Children=$SideNavigation_SideNavItems, SideNavigation_PageLevel=$PageLevel, SideNavigation_IsTop=1 %>
</nav>
<% end_if %>
