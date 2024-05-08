<%-- Search page with filter form on left, results on right --%>
<div class="nsw-container nsw-p-top-sm nsw-p-bottom-lg" data-page-type="2">

<% if $UseAdvancedSearch %>

    <div class="nsw-layout">

        <div class="nsw-layout__main">
            <%-- Render search title into main --%>
            <% include NSWDPC/Waratah/PageIntro %>
        </div>
        <div class="nsw-layout__sidebar nsw-layout__sidebar--desktop"></div>

    </div>

    <div class="nsw-layout">

        <aside class="nsw-layout__sidebar nsw-layout__sidebar--desktop">
            <% if $Form %>
                <% with $Form %>
                    <% include SilverStripe/CMS/Search/SearchForm SearchFormContext='wrth-advanced-search' %>
                <% end_with %>
            <% end_if %>
        </aside>

        <main id="main-content" class="nsw-layout__main">
            <% include NSWDPC/Waratah/Results Results=$Results, Query=$Query %>
        </main>

    </div>

<% else %>

    <div class="nsw-layout">

        <main id="main-content" class="nsw-layout__main">
            <%-- Render search title into main --%>
            <% include NSWDPC/Waratah/PageIntro %>

            <% if $SearchForm %>
                <% with $SearchForm %>
                    <div class="nsw-m-y-lg">
                        <% include SilverStripe/CMS/Search/SearchForm SearchFormContext='wrth-simple-search' %>
                    </div>
                <% end_with %>
            <% end_if %>

            <% include NSWDPC/Waratah/Results Results=$Results, Query=$Query %>

        </main>

        <aside class="nsw-layout__sidebar nsw-layout__sidebar--desktop">

        </aside>

    </div>

<% end_if %>

</div>
