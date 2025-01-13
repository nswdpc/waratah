<div class="nsw-list-item<% if $ListItem_UseBlockLink %> nsw-list-item--block<% end_if %><% if $ListItem_IsReversed == 1 %> nsw-list-item--reversed<% end_if %>">

    <div class="nsw-list-item__content">

        <% if $ListItem_PrimaryLabel %>
            <div class="nsw-list-item__label">{$ListItem_PrimaryLabel.XML}</div>
        <% end_if %>

        <% if $ListItem_DateString %>
            <div class="nsw-list-item__info">{$ListItem_DateString.XML}</div>
        <% else_if $ListItem_Date %>
            <div class="nsw-list-item__info">{$ListItem_Date.Format('d MMMM y')}</div>
        <% else_if $ListItem_DateTime %>
            <div class="nsw-list-item__info">{$ListItem_DateTime.Format("d MMMM y 'at' h:mm a")}</div>
        <% end_if %>

        <div class="nsw-list-item__title">
            <% if $ListItem_LinkURL %><a href="{$ListItem_LinkURL}"><% end_if %>
            <% if $ListItem_MenuTitle %>{$ListItem_MenuTitle.XML}<% else %>{$ListItem_Title.XML}<% end_if %>
            <% if $ListItem_LinkURL %></a><% end_if %>
        </div>

        <% if $ListItem_Info %>
        <div class="nsw-list-item__info">
            {$ListItem_Info.XML}
        </div>
        <% end_if %>

        <% if $ListItem_Abstract %>
            <div class="nsw-list-item__copy">
                {$ListItem_Abstract.XML}
            </div>
        <% else_if $ListItem_Content %>
            <div class="nsw-list-item__copy">
                {$ListItem_Content.XML}
            </div>
        <% else_if $ListItem_HTML %>
            <div class="nsw-list-item__copy">
                {$ListItem_HTML}
            </div>
        <% end_if %>

        <% if $ListItem_Tags %>
            <div class="nsw-list-item__tags">
            <% include nswds/Tags Tags_List=$ListItem_Tags %>
            </div>
        <% end_if %>

    </div>

    <% if $ListItem_Image %>
    <div class="nsw-list-item__image">
        {$ListItem_Image.Fill(500,500)}
    </div>
    <% else_if $ListItem_ImageURL %>
    <div class="nsw-list-item__image">
        <img src="{$ListItem_ImageURL.XML}" alt="{$ListItem_ImageAlt.XML}" loading="lazy">
    </div>
    <% end_if %>

</div>
