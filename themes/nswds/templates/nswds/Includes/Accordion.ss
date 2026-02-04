<% if $Accordion_Items %>
    <% if $Accordion_Details && $Accordion_ID %>
        <div class="nsw-accordion--details js-accordion-details" id="wrth-accordion-{$Accordion_ID}">
            <% include nswds/Accordion_ExpandContract Accordion_ExpandContract=$Accordion_ExpandContract, AccordionID=$Accordion_ID %>
            <% loop $Accordion_Items %>
            <details class="nsw-accordion__item" id="wrth-accordion-{$Up.Accordion_ID}-{$Pos}">
                <summary class="nsw-accordion__title">{$Title.XML}</summary>
                <div class="nsw-accordion__content-wrap">
                    <div class="nsw-accordion__content">
                        <% if $Content %>
                            <p>{$Content.XML}</p>
                        <% else_if $HTML %>
                            {$HTML}
                        <% else_if $Description %>
                            <p>{$Description.XML}</p>
                        <% end_if %>
                    </div>
                </div>
            </details>
            <% end_loop %>
        </div>
    <% else %>
        <div class="nsw-accordion js-accordion">
            <% include nswds/Accordion_ExpandContract Accordion_ExpandContract=$Accordion_ExpandContract %>
            <% loop $Accordion_Items %>
            <div class="nsw-accordion__title">{$Title.XML}</div>
            <div class="nsw-accordion__content">
                <% if $Content %>
                    <p>{$Content.XML}</p>
                <% else_if $HTML %>
                    {$HTML}
                <% else_if $Description %>
                    <p>{$Description.XML}</p>
                <% end_if %>
            </div>
            <% end_loop %>
        </div>
    <% end_if %>
<% end_if %>
