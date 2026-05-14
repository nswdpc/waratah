<header class="nsw-header">

    <div class="nsw-header__container">

        <div class="nsw-header__inner">

            <div class="nsw-header__main">
                <% include nswds/Waratah %>
            </div>

            <div class="nsw-header__menu">
                <button type="button" class="js-open-nav" aria-expanded="false" aria-controls="main-nav">
                    <% include nswds/Icon Icon='menu' %>
                    <span><span class="sr-only"><%t nswds.OPEN 'Open' %></span> <%t nswds.MENU 'Menu' %></span>
                </button>
            </div>

            <% if $SearchForm %>

            <div class="nsw-header__search">

                <button type="button" class="nsw-header-btn nsw-header-btn--search js-open-search" aria-expanded="false" aria-controls="header-search">
                    <% include nswds/Icon Icon_Icon='search' %>
                    <span class="nsw-header-btn__sub"><span class="sr-only"><%t nswds.SHOW 'Show' %></span> <%t nswds.SEARCH 'Search' %></span>
                </button>

            </div>

            <% end_if %>

        </div>

        <% if $SearchForm %>

            <% with $SearchForm %>
                <% include NSWDPC/Waratah/GlobalSearch %>
            <% end_with %>

        <% end_if %>

    </div>

</header>
