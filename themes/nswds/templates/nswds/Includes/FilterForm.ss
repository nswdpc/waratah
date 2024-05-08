<% if $VisibleFields.count > 0 %>

<form $AttributesHTML>

    <% include NSWDPC/Waratah/Forms/Notifications %>

    <% if $PanelDisplay %>
    <div class="nsw-filters__controls<% if $ShowFilterCount %> js-filters--count<% end_if %>">
        <button type="button">
            <% include nswds/Icon Icon_Icon='tune' %>
            <span>{$FilterResultsTitle}</span>
            <% if $PanelDisplay == 'right' %>
            <% include nswds/Icon Icon_Icon='keyboard_arrow_right' %>
            <% else_if $PanelDisplay == 'down' %>
            <% include nswds/Icon Icon_Icon='keyboard_arrow_down' %>
            <% end_if %>
        </button>
    </div>
    <% end_if %>

    <div class="nsw-filters__wrapper">

        <% if $PanelDisplay == 'right' %>
        <div class="nsw-filters__back">
            <button class="nsw-icon-button nsw-icon-button--flex js-close-sub-nav">
                <% include nswds/Icon Icon_Icon='keyboard_arrow_left' %>
                <span><%t nswds.BACK 'Back' %></span>
            </button>
        </div>
        <% end_if %>

        <div class="nsw-filters__title">
            <% if $Legend %>
                {$Legend.XML}
            <% else %>
                {$FilterResultsTitle}
            <% end_if %>
        </div>

        <div class="nsw-filters__list">

            <% loop $VisibleFields %>

                <% if $Up.FiltersCollapsed %>
                    <div class="nsw-filters__item">
                        <button class="nsw-filters__item-button">
                            <span class="nsw-filters__item-name">{$Title}</span>
                            <% include nswds/Icon Icon_Icon='keyboard_arrow_down' %>
                        </button>
                        <div class="nsw-filters__item-content">
                            {$FiltersCollapsedFieldHolder}
                        </div>
                    </div>
                <% else %>
                    <div class="nsw-filters__item">
                        <div class="nsw-filters__item-content">
                            {$FieldHolder}
                        </div>
                    </div>
                <% end_if %>

            <% end_loop %>

            <% loop $HiddenFields %>
            {$FieldHolder}
            <% end_loop %>

        </div>


        <% if $Actions %>

            <div class="nsw-filters__accept">
                <div class="nsw-list nsw-list--32">
                    <% loop $Actions %>
                        {$Field}
                    <% end_loop %>
                    <% if $ClearLink %>
                        <%-- a link to clear results and reset to an unfiltered listing --%>
                        <a href="{$ClearLink}"><%t nswds.CLEAR_FILTERS 'Clear all filters' %></a>
                    <% else %>
                        <button type="reset" class="nsw-button nsw-button--dark-outline"><%t nswds.CLEAR_ALL_FILTERS 'Clear all filters' %></button>
                    <% end_if %>
                </div>
            </div>

        <% else %>

            <div class="nsw-filters__cancel">
                <div class="nsw-list nsw-list--32">
                    <% if $ClearLink %>
                        <%-- a link to clear results and reset to an unfiltered listing --%>
                        <a href="{$ClearLink}"><%t nswds.CLEAR_FILTERS 'Clear all filters' %></a>
                    <% else %>
                        <button type="reset" class="nsw-button nsw-button--dark-outline"><%t nswds.CLEAR_ALL_FILTERS 'Clear all filters' %></button>
                    <% end_if %>
                </div>
            </div>

        <% end_if %>


    </div>

</form>

<% end_if %>
