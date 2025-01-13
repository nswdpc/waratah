<% if $SearchFormContext == 'nsw-header-search' %>

    <%-- header search implementation - included by nswds/Header --%>
    <div id="header-search" class="nsw-header__search-area js-search-area" hidden>

        <form role="search" {$FormAttributes}>
            <label for="{$FormName}_Search" class="sr-only"><%t nswds.SEARCH_SITE_FOR 'Search site for:' %></label>
            <input id="{$FormName}_Search" name="Search" autocomplete="off" type="search" class="nsw-header__input js-search-input" value="{$SearchQuery.XML}">
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

<% else_if $SearchFormContext == 'wrth-simple-search' %>

    <%-- single value lookup form --%>

    <form role="search" {$FormAttributes}>
        <div class="nsw-form__input-group">
            <label for="{$FormName}_Search" class="sr-only"><%t nswds.SEARCH_SITE_FOR 'Search site for:' %></label>
            <input id="{$FormName}_Search" name="Search" autocomplete="off" type="search" class="nsw-form__input" value="{$SearchQuery.XML}">
            <button class="nsw-button nsw-button--dark nsw-button--flex" type="submit"><%t nswds.SEARCH 'Search' %></button>
        </div>
        <% if $HiddenFields %>
            <% loop $HiddenFields %>
            {$Field}
            <% end_loop %>
        <% end_if %>
    </form>

<% else %>

    <%-- filter form (e.g SearchFormContext='wrth-advanced-search') --%>
    <% include nswds/FilterForm ClearLink=$CurrentPage.Link %>

<% end_if %>
