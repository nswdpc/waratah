<a
  class="nsw-quick-exit"
  href="<% if $QuickExit_URL %>{$QuickExit_URL}<% else %>https://www.google.com/webhp<% end_if %>"
  data-options="{&quot;enableEsc&quot;: true, &quot;enableCloak&quot;: true}"
  rel="nofollow noreferrer"
  id="nsw-quick-exit"
  aria-label="<%t nswds.QUICK_EXIT 'Quick exit' %>"
  aria-describedby="nsw-quick-exit__desc">
  <div class="nsw-quick-exit__content">
    <span id="nsw-quick-exit__desc" class="nsw-quick-exit__description-text">
        <%t nswds.QUICK_EXIT_DESCRIPTION 'Leave quickly using this banner or press' %> <kbd aria-label="<%t nswds.QUICK_EXIT_ESCAPE_KEY 'Escape key' %>"><%t nswds.QUICK_EXIT_ESCAPE 'Esc' %></kbd> <%t nswds.QUICK_EXIT_ESCAPE_TWICE 'twice' %>.
    </span>
    <span class="nsw-quick-exit__exit-text"><%t nswds.QUICK_EXIT_EXIT_NOW 'Exit now' %></span>
  </div>
</a>