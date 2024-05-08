
    <div class="nsw-callout">

        <% include nswds/Icon Icon_Icon=$Callout_Icon, Icon_IconExtraClass='nsw-callout__icon' %>

        <div class="nsw-callout__content">
            <% if $Title %>
                <p class="nsw-h4">{$Title.XML}</p>
            <% end_if %>
            <% if $ShortDescription %>
                <p>{$ShortDescription}</p>
            <% end_if %>
            <% if $Content %>
                {$Content}
            <% end_if %>
            <% if $Link %>
                <a href="$Link.LinkURL" class="nsw-text-link">{$Link.Title}</a>
            <% end_if %>
        </div>

    </div>

    <% if $SchemaJSON %>
    <script type="application/ld+json">
        $SchemaJSON.RAW
    </script>
    <% end_if %>
