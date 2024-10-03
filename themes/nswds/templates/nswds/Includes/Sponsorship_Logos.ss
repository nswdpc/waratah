<% if $Sponsorship_Logos %>
    <div class="wrth-sponsorship__sponsors">

    <% if $Sponsorship_IncludeWaratah == 1 %>
        <div class="wrth-sponsorship__sponsor">
            <% include nswds/Waratah_SVG Waratah_Height=76 %>
        </div>
    <% end_if %>

    <% loop $Sponsorship_Logos %>
        <div class="wrth-sponsorship__sponsor">
            <% if $URL %>
                <% if $Link %><a href="{$Link}" rel="noopener"><% end_if %><img src="{$URL}" height={$Height}><% if $Link %></a><% end_if %>
            <% else %>
                <% if $Link %><a href="{$Link}" rel="noopener"><% end_if %>{$Image.ScaleHeight(76)}<% if $Link %></a><% end_if %>
            <% end_if %>
        </div>
    <% end_loop %>
    </div>
<% end_if %>
