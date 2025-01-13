<%-- render this decorated content element into a card --%>
<div class="nsw-card nsw-card--highlight<% if $Brand %> nsw-card--{$Brand.XML}<% end_if %>">
    <% if $Top.CardStyle == "title-image-abstract" %>
        <% if $Image %>
            <div class="nsw-card__image">
                <img src="$Image.FocusFillMax(600,400).URL" alt="{$Image.Title.XML}" loading="lazy">
            </div>
        <% else_if $SiteTree.Image %>
            <div class="nsw-card__image">
                <img src="$SiteTree.Image.FocusFillMax(600,400).URL" alt="{$SiteTree.Image.Title.XML}" loading="lazy">
            </div>
        <% end_if %>
    <% end_if %>
    <div class="nsw-card__content">
        <div class="nsw-card__title">
            <a href="{$LinkURL}">{$Title.XML}</a>
        </div>
        <% if $Top.CardStyle == "title-abstract" || $Top.CardStyle == "title-image-abstract" %>
            <% if $Description %>
                <div class="nsw-card__copy">
                    <p>{$Description.XML}</p>
                </div>
            <% else_if $SiteTree.Abstract %>
                <div class="nsw-card__copy">
                    <p>{$SiteTree.Abstract.XML}</p>
                </div>
            <% end_if %>
        <% end_if %>
        <% include nswds/Icon Icon_Icon='east' %>
    </div>
</div>
