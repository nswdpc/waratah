
<div id="{$HolderID}" class="nsw-form__group wrth-form__composite<% if $Zebra %> {$Zebra}<% end_if %><% if $ParentExtraClass %> {$ParentExtraClass}<% end_if %>" data-is-composite="1">

    <% if $FormFieldHint == 'callout' %>

        <%-- render as in-page-alert --%>
        <div class="nsw-callout">
            <div class="nsw-callout__content">
            <% loop $FieldList %>
                <% if $Pos == 1 && $Up.Title %>
                    <p class="nsw-h4">{$Up.Title.XML}</p>
                <% end_if %>
                {$FieldHolder}
            <% end_loop %>
            </div>
        </div>

    <% else_if $FormFieldHint == 'inpagealert' %>

        <%-- render as in-page-alert --%>
        <div class="nsw-in-page-alert nsw-in-page-alert--info">
            <% if $FormFieldHintIcon %>
                <% include nswds/Icon Icon_Icon=$FormFieldHintIcon, Icon_IconExtraClass='nsw-in-page-alert__icon' %>
            <% else %>
                <% include nswds/Icon Icon_Icon='info', Icon_IconExtraClass='nsw-in-page-alert__icon' %>
            <% end_if %>
            <div class="nsw-in-page-alert__content">
                <% loop $FieldList %>
                    <% if $Pos == 1 && $Up.Title %>
                        <p class="nsw-h5">{$Up.Title.XML}</p>
                    <% end_if %>
                    {$FieldHolder}
                <% end_loop %>
            </div>
        </div>

    <% else %>

        <fieldset class="nsw-form__fieldset">

            <% include NSWDPC/Waratah/Forms/Legend %>

            <section class="nsw-section nsw-section--half-padding nsw-section--off-white">

                <div class="nsw-container">

                    <% include NSWDPC/Waratah/Forms/Description %>

                    <div class="field">
                    {$Field}
                    </div>

                    <% include NSWDPC/Waratah/Forms/RightTitle %>

                </div>

            </section>

        </fieldset>

    <% end_if %>

</div>
