<% if $HasGlobalExitButton %>
<span id="quick-exit-message" class="sr-only"><%t nswds.QUICK_EXIT_AVAILABLE 'Quick exit is available on this page. You can leave at any time by pressing the Escape key two times.' %></span>
<% end_if %>
<nav class="nsw-skip<% if $MastHead_Brand %> nsw-skip--{$MastHead_Brand.XML}<% end_if %>" aria-label="<%t nswds.SKIP_TO_LINKS 'Skip to links' %>">
    <a href="#main-nav"><span><%t nswds.SKIP_TO_NAVIGATION 'Skip to navigation' %></span></a>
    <a href="#main-content"><span><%t nswds.SKIP_TO_CONTENT 'Skip to content' %></span></a>
</nav>
