<div class="nsw-in-page-alert nsw-in-page-alert--<% if $InPageAlert_Level %>{$FormAlertLevel($InPageAlert_Level)}<% else %>info<% end_if %><% if $InPageAlert_IsCompact %> nsw-in-page-alert--compact<% end_if %>"<% if $InPageAlert_Content == '' %> style="display: none"<% end_if %>>

  <% if $InPageAlert_Icon %>
    <% include nswds/Icon Icon_Icon=$InPageAlert_Icon, Icon_IconExtraClass='nsw-in-page-alert__icon' %>
  <% end_if %>

  <div class="nsw-in-page-alert__content">

    <% if $InPageAlert_IsCompact %>

        <%-- compact view --%>

        <p class="nsw-small">
            <% if $InPageAlert_Title %><strong>{$InPageAlert_Title.XML}</strong> <% end_if %><% if $InPageAlert_Content %><% if $InPageAlert_Cast == 'html' %>{$InPageAlert_Content}<% else %>{$InPageAlert_Content.XML}<% end_if %><% end_if %>
        </p>

    <% else %>

        <% if $InPageAlert_Title %>
            <p class="nsw-h5">{$InPageAlert_Title.XML}</p>
        <% end_if %>

        <% if $InPageAlert_Content %>
            <% if $InPageAlert_Cast == 'html' %>
                <div>{$InPageAlert_Content}</div>
            <% else %>
                <p>{$InPageAlert_Content.XML}</p>
            <% end_if %>
        <% end_if %>

    <% end_if %>

  </div>

</div>
