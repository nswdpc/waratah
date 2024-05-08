<%-- this is a placeholder component template, see DateInputs templates/module for a functional component with validation --%>
<div class="nsw-form">
  <div class="nsw-form__group">
    <fieldset class="nsw-form__date">
      <legend>
        <span class="nsw-form__label">{$Title}</span>
        <% if $Description %><span class="nsw-form__helper">{$Description}</span><% end_if %>
      </legend>
      <div class="nsw-form__date-wrapper">
        {$DayField}
        {$MonthField}
        {$YearField}
        <% if $TimeField %>
        {$TimeField}
        <% end_if %>
      </div>
    </fieldset>
  </div>
</div>
