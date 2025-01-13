<div class="nsw-hero-banner<% if $BannerStyle == "title-content" ||  $BannerStyle == "call-to-action" %> nsw-hero-banner--wide<%end_if %><% if $BannerBrand  != '' %> nsw-hero-banner--{$BannerBrand.XML}<% end_if %>">
    <div class="nsw-hero-banner__container">
        <div class="nsw-hero-banner__wrapper">
            <div class="nsw-hero-banner__content">
                <% if $ShowTitle && $Title %>
                    <h1>{$Title.XML}</h1>
                <% end_if %>
                <% if $HTML %>
                    <div class="nsw-intro">{$HTML}</div>
                <% end_if %>
                <% if $BannerStyle == "call-to-action" || $BannerStyle == "call-to-action-image" %>
                    <%-- dark branding: nswds requires light button --%>
                    <div class="nsw-hero-banner__button">
                        <a href="{$BannerLink.LinkURL}" class="nsw-button<% if $BannerBrand == 'dark' %> nsw-button--white<% else %> nsw-button--dark<% end_if %>">{$BannerLink.Title.XML}</a>
                    </div>
                <% end_if %>
            </div>
            <% if $BannerStyle == "links-list" %>
                <div class="nsw-hero-banner__links">
                    <div class="nsw-hero-banner__list">
                        <% if $BannerLinksTitle %><div class="nsw-hero-banner__sub-title">{$BannerLinksTitle.XML}</div><% end_if %>
                        <ul>
                            <% loop $BannerLinks.Sort('Sort') %>
                                <li><a href="{$LinkURL}">{$Title.XML}</a></li>
                            <% end_loop %>
                        </ul>
                    </div>
                </div>
            <% end_if %>
            <div class="nsw-hero-banner__box"<% if $BannerStyle == "title-content" || $BannerStyle == "call-to-action" %> role="presentation"<% end_if %>>
                <% if $BannerStyle == "title-content-image" || $BannerStyle == "call-to-action-image" %>
                    <img class="nsw-hero-banner__image" src="{$Image.FocusFillMax(1000,1125).URL}" alt="{$Image.AltText}" loading="lazy">
                <% else %>
                    <div class="nsw-hero-banner__bg"></div>
                <% end_if %>
            </div>
        </div>
    </div>
</div>
