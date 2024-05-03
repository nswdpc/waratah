<% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>
<% if $HTML %>
    {$HTML}
<% end_if %>
<% if $ElementLinks %>

    <div class="nsw-carousel js-carousel" data-description="Highlighted latest news" data-navigation-pagination="on">

        <p class="sr-only"><%t nswds.CAROUSEL_ITEMS 'Items' %></p>

        <div class="nsw-carousel__wrapper js-carousel__wrapper">

            <ol class="nsw-carousel__list">

            <% loop $ElementLinks.Sort('Sort') %>
                <li class="nsw-carousel__item">
                    <% include NSWDPC/Waratah/CardInList Card_Title=$Title, Card_Link=$Me, Card_CardStyle=$Up.Up.CardStyle, Card_Image=$Image, Card_Content=$Description %>
                </li>
            <% end_loop %>

            </ol>

        </div>

        <% include nswds/CardCarousel_Navigation %>

    </div>
<% end_if %>
