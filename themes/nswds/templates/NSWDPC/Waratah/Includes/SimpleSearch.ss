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
