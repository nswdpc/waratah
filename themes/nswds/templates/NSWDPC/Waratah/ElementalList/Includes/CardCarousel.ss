<% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>
<% if $HTML %>
<div class="nsw-block">
    {$HTML}
</div>
<% end_if %>
<% if $Elements.Elements %>
<div class="nsw-block">
    <div class="nsw-carousel js-carousel"<% if $Abstract %> data-description="{$Abstract}"<% end_if %> data-navigation-pagination="on">

        <p class="sr-only"><%t nswds.CAROUSEL_ITEMS 'Items' %></p>

        <div class="nsw-carousel__wrapper js-carousel__wrapper">

            <ol class="nsw-carousel__list">

                <% loop $Elements.Elements %>
                    <li class="nsw-carousel__item">
                        <% include nswds/Card Card_Carousel=1, Card_Title=$Title, Card_LinkURL=$ContentLink.LinkURL, Card_LinkOpenInNewWindow=$ContentLink.OpenInNewWindow, Card_CardStyle=$Up.Up.CardStyle, Card_Image=$ContentImage, Card_Description=$HTML.Plain %>
                    </li>
                <% end_loop %>

            </ol>

        </div>

        <% include nswds/CardCarousel_Navigation %>

    </div>
</div>
<% end_if %>
