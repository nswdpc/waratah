<% if not $AnalyticsOptOut %>
    <% with $SiteConfig %>
        <% if $GoogleTagManagerCode %>
            <% if $GoogleImplementation == 'GTM' || $GoogleImplementation == 'GTMNonce' %>
                <noscript>
                <iframe src="https://www.googletagmanager.com/ns.html?id={$GoogleTagManagerCode.URLATT}" height="0" width="0" style="display:none;visibility:hidden"></iframe>
                </noscript>
            <% end_if %>
        <% end_if %>
    <% end_with %>
<% end_if %>
