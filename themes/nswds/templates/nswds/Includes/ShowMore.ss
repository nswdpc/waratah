  <div class="nsw-show-more" id="show-more-supplementary">
    <div class="nsw-show-more__summary">
      <p>{$ShowMore_Summary}</p>
    </div>
    <details class="nsw-show-more__details">
      <summary class="nsw-show-more__toggle">
        <span class="nsw-show-more__toggle-text nsw-show-more__toggle-text--show"><%t nswds.SHOW_MORE_TOGGLE_MORE 'Show more' %></span>
        <span class="nsw-show-more__toggle-text nsw-show-more__toggle-text--hide"><%t nswds.SHOW_MORE_TOGGLE_LESS 'Show less' %></span><% if $ShowMore_ToggleSuffix %> <span class="sr-only">{$ShowMore_ToggleSuffix}</span><% end_if %>
        <% include nswds/Icon Icon_Icon='keyboard_arrow_down', Icon_IconExtraClass='nsw-show-more__icon' %>
      </summary>
      <div class="nsw-show-more__content">
        {$ShowMore_Content}
      </div>
    </details>
  </div>
