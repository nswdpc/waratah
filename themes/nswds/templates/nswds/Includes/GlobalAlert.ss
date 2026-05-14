<% if $GlobalSpecialAnnouncements %>

    <% loop $GlobalSpecialAnnouncements %>

    <div class="nsw-global-alert<% if $GlobalAlert_AlertState=='critical' %> nsw-global-alert--critical<% else_if $GlobalAlert_AlertState=='light' %> nsw-global-alert--light<% end_if %> js-global-alert" role="alert" data-cookie-name="{$GlobalAlert_CookieName}">

        <div class="nsw-global-alert__wrapper">

            <div class="nsw-global-alert__content">
                <div class="nsw-global-alert__title">{$GlobalAlert_Title.XML}</div>
                <p>{$GlobalAlert_Content.XML}<% if not $GlobalAlert_UseButtonLink %> <a href="{$GlobalAlert_LinkURL}"><% if $GlobalAlert_LinkTitle %>{$GlobalAlert_LinkTitle}<% else %><%t nswds.MORE_INFORMATION 'More information' %></a><% end_if %><% end_if %></p>
            </div>

            <% if $GlobalAlert_UseButtonLink %>

                <p>

                <% if $GlobalAlert_AlertState=='light' %>
                    <%-- light state needs a non-white button class --%>
                    <% if $GlobalAlert_ButtonTitle %>
                        <% include nswds/Button Button_LinkURL=$GlobalAlert_LinkURL, Button_Title=$GlobalAlert_ButtonTitle, Button_State='info' %>
                    <% else %>
                        <% include nswds/Button Button_LinkURL=$GlobalAlert_LinkURL, Button_Title='More information', Button_State='info' %>
                    <% end_if %>
                <% else %>
                    <% if $GlobalAlert_ButtonTitle %>
                        <% include nswds/Button Button_LinkURL=$GlobalAlert_LinkURL, Button_Title=$GlobalAlert_ButtonTitle, Button_State='white' %>
                    <% else %>
                        <% include nswds/Button Button_LinkURL=$GlobalAlert_LinkURL, Button_Title='More information', Button_State='white' %>
                    <% end_if %>
                <% end_if %>

                </p>

            <% end_if %>

            <button type="button" class="nsw-icon-button js-close-alert" type="button" aria-expanded="true">
                <% include nswds/Icon Icon_Icon='close' %>
                <span class="sr-only"><%t nswds.CLOSE_MESSAGE 'Close message' %></span>
            </button>

        </div>

        <% if $GlobalAlert_SchemaJSON %>
        <script type="application/ld+json">
            {$GlobalAlert_SchemaJSON.RAW}
        </script>
        <% end_if %>


    </div>

    <% end_loop %>

<% end_if %>
