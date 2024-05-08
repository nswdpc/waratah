<% if $ElementSearchForm %>

<div class="wrth-feature">

    <div class="nsw-grid">

        <div class="nsw-col nsw-col-md-8">

            <div class="wrth-feature__content">

                <% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>

                <% if $Content %>
                    <p class="nsw-intro">{$Content}</p>
                <% end_if %>

                <% with $ElementSearchForm %>

                <div class="nsw-p-top-lg">
                    <form role="search" {$FormAttributes}>
                        <% if $Up.FieldTitle %>
                            <label class="nsw-form__label" for="{$FormName}_Search">{$Up.FieldTitle}</label>
                        <% end_if %>
                        <div class="nsw-form__input-group">
                            <input id="{$FormName}_Search" name="Search" type="search" class="nsw-form__input" value="{$SearchQuery.XML}">
                            <button class="nsw-button nsw-button--dark nsw-button--flex" type="submit"><%t nswds.SEARCH 'Search' %></button>
                        </div>
                        <% if $HiddenFields %>
                            <% loop $HiddenFields %>
                            {$Field}
                            <% end_loop %>
                        <% end_if %>
                    </form>
                </div>

                <% end_with %>
            </div>

        </div>

        <div class="nsw-col nsw-col-md-4">

            <div class="wrth-feature__graphic">
                {$Image.Fill(390,300)}
            </div>

        </div>

    </div>

</div>

<% end_if %>
