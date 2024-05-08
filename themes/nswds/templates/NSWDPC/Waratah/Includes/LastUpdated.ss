<% if $PageLastUpdated %>
<section class="nsw-section">
    <% if $Top.IsLandingPage %>
        <div class="nsw-container">
    <% end_if %>

    <% with $PageLastUpdated %>
        <p><strong><%t nswds.PAGE_LAST_UPDATE 'Last updated' %>:</strong> <time datetime="{$Machine}">{$Human}</time></p>
    <% end_with %>

    <% if $Top.IsLandingPage %>
    </div>
    <% end_if %>

</section>
<% end_if %>
