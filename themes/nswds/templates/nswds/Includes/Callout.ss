<div class="nsw-callout">
    <div class="nsw-callout__content">
        <p class="nsw-h4">{$Callout_Title.XML}</p>
        <% if $Callout_HTML %>
            {$Callout_HTML}
        <% else_if $Callout_Content %>
            <p>{$Callout_Content.XML}</p>
        <% end_if %>
        <% if $Callout_LinkText && $Callout_LinkURL %>
        <p><a href="{$Callout_LinkURL}">{$Callout_LinkText}</a></p>
        <% else_if $Callout_Link %>
            <% with $Callout_Link %>
                <p><a href="{$LinkURL}"<% if $OpenInNewWindow %> target="_blank"<% end_if %>>{$Title}</a></p>
            <% end_with %>
        <% end_if %>
    </div>
</div>
