<% if not $Card_Carousel %>
<div class="nsw-col<% if $Card_ColumnOptions %> $Card_ColumnOptions.XML<% else %> nsw-col-md-4<% end_if %>">
<% end_if %>

    <div class="nsw-card<% if $Card_Horizontal %> nsw-card--horizontal<% end_if %><% if $Card_Highlight %> nsw-card--highlight<% end_if %><% if $Card_HeadlineOnly %> nsw-card--headline<% end_if %><% if $Card_Brand %> nsw-card--{$Card_Brand.XML}<% end_if %>">

        <% if $Card_HeadlineOnly %>

            <div class="nsw-card__content">

                <div class="nsw-card__title">
                    <a href="{$Card_LinkURL}"<% if $Card_LinkOpenInNewWindow %> target="_blank" rel="noopener noreferrer"<% end_if %>>{$Card_Title.XML}</a>
                </div>

                <% if $Card_LinkIcon == '' %>
                    <% include nswds/Icon Icon_Icon='east' %>
                <% else %>
                    <% include nswds/Icon Icon_Icon=$Card_LinkIcon %>
                <% end_if %>

            </div>

        <% else %>

            <% if $Card_Image || $Card_ImageURL %>
            <%-- note: card image height is restricted to 200px @ 16px/em --%>
            <div class="nsw-card__image">
                <% if $Card_Image %>
                    <% if $Card_ImageWidth || $Card_ImageHeight %>
                        <% if not $Card_ImageHeight %>
                            {$Card_Image.ScaleWidth($Card_ImageWidth)}
                        <% else %>
                            {$Card_Image.Fill($Card_ImageWidth, $Card_ImageHeight)}
                        <% end_if %>
                    <% else %>
                         {$Card_Image.ScaleHeight(200)}
                    <% end_if %>
                <% else %>
                    <img src="{$Card_ImageURL.XML}" height="200" loading="lazy">
                <% end_if %>
            </div>
            <% end_if %>

            <div class="nsw-card__content">

                <% if $Card_Tags && $Card_Tags.Count > 0 %>
                    <%-- only the first in the list is shown --%>
                    <div class="nsw-card__tag">{$Card_Tags.First.Name.XML}</div>
                <% else_if $Card_Tag %>
                    <div class="nsw-card__tag">{$Card_Tag.XML}</div>
                <% end_if %>

                <% if $Card_Date %>
                    <div class="nsw-card__date">
                        <time datetime="{$Card_Date.Format('yyyy-MM-dd')}">{$Card_Date.Long}</time>
                    </div>
                <% end_if %>

                <div class="nsw-card__title">
                    <a href="{$Card_LinkURL}"<% if $Card_LinkOpenInNewWindow %> target="_blank" rel="noopener noreferrer"<% end_if %>>{$Card_Title.XML}</a>
                </div>

                <div class="nsw-card__copy">
                <% if $Card_Description %>
                    <p>{$Card_Description.XML}</p>
                <% else_if $Card_Content %>
                    <p>{$Card_Content.XML}</p>
                <% end_if %>
                </div>

                <% if $Card_LinkIcon == '' %>
                    <% include nswds/Icon Icon_Icon='east' %>
                <% else %>
                    <% include nswds/Icon Icon_Icon=$Card_LinkIcon %>
                <% end_if %>

            </div>

        <% end_if %>

    </div>

<% if not $Card_Carousel %>
</div>
<% end_if %>
