<div class="nsw-grid">
<% loop $Items %>

    <% if $Up.Columns %>
    <div class="nsw-col<% if $Up.Columns %> {$Up.Columns}<% end_if %>">
    <% else %>
    <div class="nsw-col nsw-col-xs-12 nsw-col-sm-6 nsw-col-md-4 nsw-col-lg-3">
    <% end_if %>

        <div class="nsw-card nsw-card--highlight<% if $Up.Brand %> nsw-card--{$Up.Brand.XML}<% end_if %>">
            <% if $Image %>
                <div class="nsw-card__image">
                    <img src="{$Image.FocusFillMax(400,200).URL}" alt="{$Image.AltText.XML}" loading="lazy">
                </div>
            <% end_if %>
            <div class="nsw-card__content">

                <div class="nsw-card__date">
                    <time datetime="{$Date.XML}">{$Date.Long}</time>
                </div>

                <% if $MediaPageAttributes %>
                    <% with $MediaPageAttributes.Filter('MediaAttribute.Title','Author').First %>
                        <% if $Content %>
                        <div class="nsw-card__tag">{$Content.XML}</div>
                        <% end_if %>
                    <% end_with %>
                <% end_if %>

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
