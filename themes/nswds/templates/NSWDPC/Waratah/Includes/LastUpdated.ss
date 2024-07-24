<% if $PageLastUpdated %>
<div class="nsw-container">
    <section class="nsw-section">

    <% with $PageLastUpdated %>
        <p><strong><%t nswds.PAGE_LAST_UPDATE 'Last updated' %>:</strong> <time datetime="{$Machine}">{$Human}</time></p>
    <% end_with %>

    </section>
</div>
<% end_if %>
