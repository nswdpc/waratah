<% if $SortedSlides %>

    <% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>

    <% if $HTML %>
    <div class="nsw-block">
        <% if $HTML %>
            {$HTML}
        <% end_if %>
    </div>
    <% end_if %>

    <% if $DerivedHeroLink %>
    <div class="nsw-block">
        <% with $DerivedHeroLink %><a href="{$LinkURL}" rel="noopener noreferrer"<% if $OpenInNewWindow %> target="_blank"<% end_if %> class="nsw-button nsw-button--dark">{$Title}</a><% end_with %>
    </div>
    <% end_if %>

    <div class="nsw-block">
        <div class="nsw-carousel js-carousel" data-navigation-pagination="on">
            <p class="sr-only"><%t nswds.SLIDER_ITEMS 'Slides related to this content' %></p>
            <div class="nsw-carousel__wrapper js-carousel__wrapper">
                <ol class="nsw-carousel__list">
                <% loop $SortedSlides %>
                <%-- Slide.ss --%>
                {$Me}
                <% end_loop %>
                </ol>
            </div>
            <% include nswds/CardCarousel_Navigation %>
        </div>
    </div>

<% end_if %>
