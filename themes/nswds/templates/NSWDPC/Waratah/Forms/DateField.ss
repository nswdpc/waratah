<div class="nsw-date-input__wrapper nsw-form__input-group nsw-form__input-group--icon">
  <input {$AttributesHTML}>

  <button class="nsw-button nsw-button--dark nsw-button--flex js-date-input__trigger" aria-label="<%t wrth.SELECT_DATE_USING_PICKER 'Select date using calendar widget' %>" type="button">
    <% include nswds/Icon Icon_Icon='calendar_today' %>
  </button>
</div>

<div class="nsw-date-picker js-date-picker" role="dialog" aria-labelledby="calendar-label-{$ID}">
  <header class="nsw-date-picker__header">
    <div class="nsw-date-picker__title">
      <span class="nsw-date-picker__title-label js-date-picker__title-label" id="calendar-label-{$ID}"></span>

      <nav>
        <ul class="nsw-date-picker__title-nav js-date-picker__title-nav">
          <li>
            <button class="nsw-icon-button nsw-date-picker__title-nav-btn js-date-picker__year-nav-btn js-date-picker__year-nav-btn--prev" type="button">
              <% include nswds/Icon Icon_Icon='keyboard_double_arrow_left' %>
            </button>
            <button class="nsw-icon-button nsw-date-picker__title-nav-btn js-date-picker__month-nav-btn js-date-picker__month-nav-btn--prev" type="button">
              <% include nswds/Icon Icon_Icon='chevron_left' %>
            </button>
          </li>

          <li>
            <button class="nsw-icon-button nsw-date-picker__title-nav-btn js-date-picker__month-nav-btn js-date-picker__month-nav-btn--next" type="button">
               <% include nswds/Icon Icon_Icon='chevron_right' %>
            </button>
            <button class="nsw-icon-button nsw-date-picker__title-nav-btn js-date-picker__year-nav-btn js-date-picker__year-nav-btn--next" type="button">
              <% include nswds/Icon Icon_Icon='keyboard_double_arrow_right' %>
            </button>
          </li>
        </ul>
      </nav>
    </div>

    <ol class="nsw-date-picker__week">
      <li><div class="nsw-date-picker__day"><%t wrth.DAY_MONDAY_START 'M' %><span class="sr-only"><%t wrth.DAY_MONDAY_END 'onday' %></span></div></li>
      <li><div class="nsw-date-picker__day"><%t wrth.DAY_TUESDAY_START 'T' %><span class="sr-only"><%t wrth.DAY_TUESDAY_END 'uesday' %></span></div></li>
      <li><div class="nsw-date-picker__day"><%t wrth.DAY_WEDNESDAY_START 'W' %><span class="sr-only"><%t wrth.DAY_WEDNESDAY_END 'ednesday' %></span></div></li>
      <li><div class="nsw-date-picker__day"><%t wrth.DAY_THURSDAY_START 'T' %><span class="sr-only"><%t wrth.DAY_THURSDAY_END 'hursday' %></span></div></li>
      <li><div class="nsw-date-picker__day"><%t wrth.DAY_FRIDAY_START 'F' %><span class="sr-only"><%t wrth.DAY_FRIDAY_END 'riday' %></span></div></li>
      <li><div class="nsw-date-picker__day"><%t wrth.DAY_SATURDAY_START 'S' %><span class="sr-only"><%t wrth.DAY_SATURDAY_END 'aturday' %></span></div></li>
      <li><div class="nsw-date-picker__day"><%t wrth.DAY_SUNDAY_START 'S' %><span class="sr-only"><%t wrth.DAY_SUNDAY_END 'unday' %></span></div></li>
    </ol>
  </header>

  <ol class="nsw-date-picker__dates js-date-picker__dates" aria-labelledby="calendar-label-{$ID}">
  </ol>

  <div class="nsw-date-picker__buttongroup">
    <button type="button" class="nsw-button nsw-button--dark-outline-solid js-date-picker__close" value="cancel"><%t wrth.CANCEL 'Cancel' %></button>
    <button type="button" class="nsw-button nsw-button--dark js-date-picker__accept" value="ok"><%t wrth.OK 'OK' %></button>
  </div>
</div>
