<% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>
<% if $HTML %>
<div class="nsw-block">
    {$HTML}
</div>
<% end_if %>
<% if $ElementLinks.Sort('Sort') %>
<div class="nsw-block">
    <div class="nsw-carousel js-carousel"<% if $Abstract %> data-description="{$Abstract}"<% end_if %> data-navigation-pagination="on">

        <p class="sr-only"><%t nswds.CAROUSEL_ITEMS 'Items' %></p>

        <div class="nsw-carousel__wrapper js-carousel__wrapper">

            <ol class="nsw-carousel__list">

            <% loop $ElementLinks.Sort('Sort') %>
                <li class="nsw-carousel__item">
                    <% include nswds/Card Card_Carousel=1, Card_Title=$Title, Card_LinkURL=$LinkURL, Card_LinkOpenInNewWindow=$OpenInNewWindow, Card_CardStyle=$Up.Up.CardStyle, Card_Image=$LinkImage, Card_Description=$LinkDescription %>
                </li>
            <% end_loop %>

            </ol>

        </div>

        <% include nswds/CardCarousel_Navigation %>

    </div>
</div>
<% end_if %>
