<div class="nsw-callout">
    <div class="nsw-callout__content">
        <p class="nsw-h4">{$Callout_Title.XML}</p>
        <% if $Callout_HTML %>
            {$Callout_HTML}
        <% else_if $Callout_Content %>
            <p>{$Callout_Content.XML}</p>
        <% end_if %>
        <% if $Callout_LinkText && $Callout_LinkURL %>
            <a href="{$Callout_LinkURL}">{$Callout_LinkText}</a>
        <% else_if $Callout_Link %>
            <% with $Callout_Link %>
                <a href="{$LinkURL}">{$Title}</a>
            <% end_with %>
        <% end_if %>
    </div>
</div>
