<% if $SupportList_Logos %>
    <div class="nsw-support-list__logo-grid">

    <% if $SupportList_IncludeWaratah == 1 %>
        <% include nswds/Waratah_SVG Waratah_Height=76 %>
    <% end_if %>

    <% loop $SupportList_Logos %>
        <img src="{$Pad(160,76).URL}" loading="lazy" width="160" height="76" class="nsw-support-list__logo-grid__item">
    <% end_loop %>

    </div>
<% end_if %>
