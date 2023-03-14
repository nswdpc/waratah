<% if not $AnalyticsOptOut %>
    <% with $SiteConfig %>
        {$ProvideAnalyticsImplementation}
    <% end_with %>
<% end_if %>
