<% if $PaginatedChildren %>

    <% include nswds/Pagination Pagination_PaginatedItems=$PaginatedChildren(12), SummaryLimit=4 %>

    <% if $MediaType.Title == "Publication" %>

    <div class="nsw-block">
        <% loop $PaginatedChildren(12,"Title","ASC") %>
        <div class="nsw-list-item">
          <div class="nsw-list-item__content">

              <% if $MediaPageAttributes %>

                  <% with $MediaPageAttributes.Filter('MediaAttribute.Title','Author').First %>
                      <% if $Content %>
                      <div class="nsw-list-item__label">{$Content.XML}</div>
                      <% end_if %>
                  <% end_with %>

              <% end_if %>

                <% if $Date %>
                    <div class="nsw-list-item__info"><time datetime="{$Date.XML}">{$Date.Long}</time></div>
                <% end_if %>

                <div class="nsw-list-item__title">
                    <a href="{$Link.XML}"><% if $MenuTitle %>$MenuTitle.XML<% else %>$Title.XML<% end_if %></a>
                </div>

                <div class="nsw-list-item__copy">
                <% if $MetaDescription %>
                    {$MetaDescription.ContextSummary(350)}
                <% else_if $Abstract %>
                    {$Abstract.ContextSummary(350)}
                <% else_if $ElementsForSearch %>
                    {$ElementsForSearch.RAW.ContextSummary(350)}
                <% end_if %>
                </div>

                <% if $Tags %>
                <div class="nsw-list-item__tags">
                    <% include nswds/Tags Tags_List=$Tags %>
                </div>
                <% end_if %>

            </div>
        </div>
        <% end_loop %>
    </div>

    <% else %>

    <div class="nsw-grid">
        <% loop $PaginatedChildren(12) %>
            <div class="nsw-col nsw-col-sm-<% if $Up.IsLandingPage %>4<% else %>6<% end_if %>">
                <div class="nsw-card nsw-card--highlight<% if $Up.Brand %> nsw-card--{$Up.Brand.XML}<% end_if %>">
                    <% if $Image %>
                        <div class="nsw-card__image">
                            <img src="{$Image.FocusFillMax(400,200).URL}" alt="{$Image.AltText.XML}" loading="lazy">
                        </div>
                    <% end_if %>
                    <div class="nsw-card__content">

                        <% if $MediaPageAttributes %>

                            <% with $MediaPageAttributes.Filter('MediaAttribute.Title','Author').First %>
                                <% if $Content %>
                                <div class="nsw-card__tag">{$Content.XML}</div>
                                <% end_if %>
                            <% end_with %>

                        <% end_if %>

                        <div class="nsw-card__date">
                            <time datetime="{$Date.XML}">{$Date.Long}</time>
                        </div>

                        <div class="nsw-card__title">
                            <a href="{$Link}">{$MenuTitle.XML}</a>
                        </div>

                        <% if $MetaDescription %>
                            <div class="nsw-card__copy"><p>{$MetaDescription.XML}</p></div>
                        <% else_if $Abstract %>
                            <div class="nsw-card__copy"><p>{$Abstract.XML}</p></div>
                        <% end_if %>

                        <% include nswds/Icon Icon_Icon='east' %>
                    </div>
                </div>
            </div>
        <% end_loop %>
    </div>
    <% end_if %>

    <% include nswds/Pagination Pagination_PaginatedItems=$PaginatedChildren(12), SummaryLimit=4 %>

<% end_if %>
