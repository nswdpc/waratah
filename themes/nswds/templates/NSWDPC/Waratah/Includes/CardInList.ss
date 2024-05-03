<div class="nsw-card nsw-card--highlight<% if $Card_Brand %> nsw-card--{$Card_Brand.XML}<% end_if %>">

    <% if $Card_CardStyle == "title-image-abstract" %>
        <% if $Card_Image %>
            <div class="nsw-card__image">
                {$Card_Image.FocusFillMax(600,400)}
            </div>
        <% end_if %>
    <% end_if %>

    <div class="nsw-card__content">

        <div class="nsw-card__title">
            <% if $Card_Link %>
                <a href="{$Card_Link.LinkURL}"<% if $Card_Link.OpenInNewWindow %> target="_blank" rel="noopener noreferrer"<% end_if %>>{$Card_Title.XML}</a>
            <% end_if %>
        </div>

        <% if $Card_CardStyle == "title-abstract" || $Card_CardStyle == "title-image-abstract" %>
            <% if $Card_Content %>
                <div class="nsw-card__copy">
                    <p>{$Card_Content.XML}</p>
                </div>
            <% end_if %>
        <% end_if %>

        <% if $Card_Link %>
            <% include nswds/Icon Icon_Icon='east' %>
        <% end_if %>

    </div>

</div>
