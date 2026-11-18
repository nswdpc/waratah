<div class="wrth-feature__content">

    <div class="nsw-block">
        {$HTML}
    </div>

    <% if $DerivedLinkTarget %>
        <div class="nsw-block">
            <p><a href="{$DerivedLinkTarget.LinkURL}"<% if $DerivedLinkTarget.OpenInNewWindow %> target="_blank"<% end_if %>><% if $CallToAction %>{$CallToAction}<% else %>{$DerivedLinkTarget.Title}<% end_if %></a></p>
        </div>
    <% end_if %>

</div>
