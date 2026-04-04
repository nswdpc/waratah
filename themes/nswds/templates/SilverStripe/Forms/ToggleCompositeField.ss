<div class="nsw-accordion--details js-accordion-details" id="wrth-accordion-{$ID}">
    <details class="nsw-accordion__item" id="wrth-accordion-{$ID}-1"<% if not $StartClosed %> open<% end_if %>>
        <summary class="nsw-accordion__title">{$Title.XML}</summary>
        <div class="nsw-accordion__content-wrap">
            <div class="nsw-accordion__content">
                <% loop $FieldList %>
                    {$FieldHolder}
                <% end_loop %>
            </div>
        </div>
    </details>
</div>
