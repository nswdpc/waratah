<% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>
<% if $HTML %>
    {$HTML}
<% end_if %>

<% if $Elements.Elements %>

    <div class="nsw-carousel js-carousel" data-description="Highlighted latest news" data-navigation-pagination="on">

        <p class="sr-only"><%t nswds.CAROUSEL_ITEMS 'Items' %></p>

        <div class="nsw-carousel__wrapper js-carousel__wrapper">

            <ol class="nsw-carousel__list">

                <% loop $Elements.Elements %>
                    <li class="nsw-carousel__item">
                        <% include NSWDPC/Waratah/CardInList Card_Title=$Title, Card_Link=$ContentLink, Card_CardStyle=$Up.Up.CardStyle, Card_Image=$ContentImage, Card_Content=$HTML.Plain %>
                    </li>
                <% end_loop %>

            </ol>

        </div>

        <% include nswds/CardCarousel_Navigation %>

    </div>
<% end_if %>
