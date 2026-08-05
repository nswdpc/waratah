<% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>
<% if $Content %>
<div class="nsw-block">
{$Content}
</div>
<% end_if %>
<figure class="nsw-media">
<% if $IsLazy && $HasPolyfill %><noscript class="loading-lazy"><% end_if %>
    <iframe
        <% if $AlternateContent %>title="{$AlternateContent.XML}"<% end_if %>
        aria-label="chart"
        id="{$DatawrapperIdAttribute.XML}"
        class="dw"
        src="{$DatawrapperURL.XML}"
        scrolling="no"
        frameborder="0"
        <% if $DefaultAllowAttributes %>allow="$DefaultAllowAttributes"<% end_if %>
        <% if $IsLazy %>loading="lazy"<% end_if %>
        height="{$IframeHeight.XML}">
    </iframe>
<% if $IsLazy && $HasPolyfill %></noscript><% end_if %>
</figure>
