<% if $HeroSearch_ImageHTML %>
<div class="nsw-section nsw-section--image-html">
<% else %>
<div class="nsw-section nsw-section--image"<% if $HeroSearch_Image %> style="background-image: url({$HeroSearch_Image.FocusFillMax(1920,640).URL});"<% else_if $HeroSearch_ImageURL %> style="background-image: url({$HeroSearch_ImageURL.XML});"<% end_if %>>
<% end_if %>

    <div class="hero-search">

        <div class="nsw-container">

            <div class="hero-search__wrapper">

                <div class="hero-search__content">

                    <h1>{$HeroSearch_Title.XML}</h1>

                    <% if $HeroSearch_Subtitle %>
                    <p class="nsw-intro">{$HeroSearch_Subtitle.XML}</p>
                    <% end_if %>

                    <% if $HeroSearch_Form %>
                        <% with $HeroSearch_Form %>
                            <form role="search" class="hero-search__form" {$FormAttributes}>
                                <div class="nsw-form__input-group nsw-form__input-group--icon nsw-form__input-group--large">
                                    <label for="{$FormName}_Search" class="sr-only"><%t nswds.SEARCH_SITE_FOR 'Search site for' %>:</label>
                                    <input autocomplete="off" id="{$FormName}_Search" name="<% if $SearchFieldName %>{$SearchFieldName.XML}<% else %><%t nswds.SEARCH 'Search' %><% end_if %>" type="text" class="nsw-form__input" value="{$SearchQuery.XML}" aria-label="<%t nswds.SEARCH 'Search' %>" aria-describedby="{$FormName}_action_results">
                                    <button class="nsw-button nsw-button--dark nsw-button--flex" type="submit" aria-label="search">
                                        <% include nswds/Icon Icon_Icon='search' %>
                                        <span class="sr-only"><%t nswds.SEARCH 'Search' %></span>
                                    </button>
                                </div>
                                <% if $HiddenFields %>
                                <% loop $HiddenFields %>
                                {$Field}
                                <% end_loop %>
                                <% end_if %>
                            </form>
                        <% end_with %>
                    <% end_if %>

                    <% if $HeroSearch_Links %>
                        <div class="hero-search__suggested">
                            <ul>
                                <% loop $HeroSearch_Links %>
                                    <li><a href="{$LinkURL}">{$Title.XML}</a></li>
                                <% end_loop %>
                            </ul>
                        </div>
                    <% else_if $HeroSearch_Terms %>
                        <div class="hero-search__suggested">
                            <ul>
                                <% loop $HeroSearch_Terms %>
                                    <li><a href="{$Link}">{$Title.XML}</a></li>
                                <% end_loop %>
                            </ul>
                        </div>
                    <% end_if %>

                </div>
                <%-- content --%>

            </div>
            <%-- wrapper --%>

        </div>

    </div>
    <% if $HeroSearch_ImageHTML && $HeroSearch_Image %>
        {$HeroSearch_Image.FocusFillMax(1920,640)}
    <% end_if %>
</div>
