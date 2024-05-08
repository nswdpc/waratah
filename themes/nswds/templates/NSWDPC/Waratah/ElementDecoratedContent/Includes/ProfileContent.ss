<div class="wrth-feature__content">

    <div class="nsw-block">
        {$HTML}
    </div>

    <% if $LinkTarget %>
        <div class="nsw-block">
            <p><a href="{$LinkTarget.LinkURL}"><% if $CallToAction %>{$CallToAction}<% else %>{$LinkTarget.Title}<% end_if %></a></p>
        </div>
    <% end_if %>

</div>
