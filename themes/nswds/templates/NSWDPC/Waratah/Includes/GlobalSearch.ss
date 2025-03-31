<%-- global search implementation - included by nswds/Header --%>
<div id="header-search" class="nsw-header__search-area js-search-area" hidden>

    <form role="search" {$FormAttributes}>
        <label for="{$FormName}_Search" class="sr-only"><%t nswds.SEARCH_SITE_FOR 'Search site for:' %></label>
        <input id="{$FormName}_Search" name="Search" autocomplete="off" type="text" class="nsw-header__input js-search-input" value="{$SearchQuery.XML}">
        <button class="nsw-icon-button nsw-icon-button--flex" type="submit">
            <% include nswds/Icon Icon_Icon='search' %>
            <span class="sr-only"><%t nswds.SEARCH 'Search' %></span>
        </button>
        <% if $HiddenFields %>
            <% loop $HiddenFields %>
            {$Field}
            <% end_loop %>
        <% end_if %>
    </form>

    <button class="nsw-icon-button js-close-search" aria-expanded="true" aria-controls="header-search">
        <% include nswds/Icon Icon_Icon='close' %>
        <span class="sr-only"><%t nswds.CLOSE_SEARCH 'Close search' %></span>
    </button>

</div>
