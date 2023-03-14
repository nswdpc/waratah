<% if $SortedSectionNavigation %>

    <% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>

    <div class="nsw-grid">
    <% loop $SortedSectionNavigation %>

        <% if $Up.Columns %>
        <div class="nsw-col {$Up.Columns}">
        <% else %>
        <div class="nsw-col nsw-col-xs-12">
        <% end_if %>

            <div class="nsw-card nsw-card--highlight<% if $Up.Brand %> nsw-card--{$Up.Brand.XML}<% end_if %><% if $Up.IsHorizontal %> nsw-card--horizontal<% end_if %>">

                <% if $Up.ShowImage && $Image %>
                    <div class="nsw-card__image">
                        {$Image.FocusFillMax(400,200)}
                    </div>
                <% end_if %>

                <div class="nsw-card__content">

                    <% if $PageLastUpdated %>
                    <div class="nsw-card__date">
                        <time datetime="{$PageLastUpdated.Machine}">{$PageLastUpdated.Human}</time>
                    </div>
                    <% end_if %>

                    <div class="nsw-card__title">
                        <a href="{$Link}">{$MenuTitle.XML}</a>
                    </div>

                    <% if $Up.ShowAbstract %>
                        <% if $Abstract %>
                            <div class="nsw-card__copy">{$Abstract.ContextSummary(350)}</div>
                        <% else_if $MetaDescription %>
                            <div class="nsw-card__copy">{$MetaDescription.ContextSummary(350)}</div>
                        <% end_if %>
                    <% end_if %>

                    <% include nswds/Icon Icon_Icon='east' %>

                </div>
            </div>

        </div>

    <% end_loop %>
    </div>

<% end_if %>
