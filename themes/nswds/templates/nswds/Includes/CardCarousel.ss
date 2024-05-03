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

  <nav>
      <ul>
        <li>
          <button aria-controls="nsw-carousel__list" aria-label="<%t nswds.SHOW_PREVIOUS_ITEMS 'Show previous items' %>" class="nsw-carousel__control nsw-carousel__control--prev js-carousel__control">
            <svg class="nsw-icon" viewBox="0 0 20 20">
              <title><%t nswds.SHOW_PREVIOUS_ITEMS 'Show previous items' %></title>
              <polyline points="13 2 5 10 13 18" fill="none" stroke="currentColor" stroke-linecap="square" stroke-linejoin="square" stroke-width="2" />
            </svg>
          </button>
        </li>
        <li>
          <button aria-controls="nsw-carousel__list" aria-label="<%t nswds.SHOW_NEXT_ITEMS 'Show next items' %>" class="nsw-carousel__control nsw-carousel__control--next js-carousel__control">
            <svg class="nsw-icon" viewBox="0 0 20 20">
              <title><%t nswds.SHOW_NEXT_ITEMS 'Show next items' %></title>
              <polyline points="7 2 15 10 7 18" fill="none" stroke="currentColor" stroke-linecap="square" stroke-linejoin="square" stroke-width="2" />
            </svg>
          </button>
        </li>
      </ul>
  </nav>

</div>
<% end_if %>
