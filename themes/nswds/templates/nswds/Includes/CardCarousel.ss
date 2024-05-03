<% if $CardCarousel_Items %>
<div class="nsw-carousel js-carousel" data-description="Highlighted latest news" data-navigation-pagination="on">

  <p class="sr-only"><%t nswds.CAROUSEL_ITEMS 'Items' %></p>

  <div class="nsw-carousel__wrapper js-carousel__wrapper">
    <ol class="nsw-carousel__list">
    <% loop $CardCarousel_Items %>
        <li class="nsw-carousel__item">
        <%-- some values come from the parent context --%>
        <% include nswds/Card Card_Carousel=1, Card_HeadlineOnly=$Up.Card_HeadlineOnly, Card_Highlight=$Up.Card_Highlight, Card_Horizontal=$Up.Card_Horizontal %>
        </li>
    <% end_loop %>
    </ol>
  </div>

  <% include nswds/CardCarousel_Navigation %>

</div>
<% end_if %>
