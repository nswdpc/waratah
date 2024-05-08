<%-- this is a different layout to the other pages --%>

<div class="nsw-container nsw-p-top-sm nsw-p-bottom-lg">

    <% if not $IsKeywordLookup %>
    <div class="nsw-layout">

        <div class="nsw-layout__main">

            <% include NSWDPC/Waratah/PageContentTitle %>

            <% include NSWDPC/Waratah/PageContentAbstract %>

        </div>

        <div class="nsw-layout__sidebar nsw-layout__sidebar--desktop">
        </div>

    </div>
    <% end_if %>

    <div class="nsw-layout">

        <% if not $IsKeywordLookup %>

            <aside class="nsw-layout__sidebar">

                <% if $DirectorySearchForm %>
                    {$DirectorySearchForm}
                <% end_if %>

            </aside>

        <% end_if %>

        <main id="main-content" class="nsw-layout__main">

            <article>

                <% if $IsKeywordLookup %>

                    <% include NSWDPC/Waratah/PageContentTitle %>

                    <% include NSWDPC/Waratah/PageContentAbstract %>
                <% end_if %>

                <div class="nsw-block">
                    <% include NSWDPC/Members/Message %>
                </div>

                <% if $IsKeywordLookup && $DirectorySearchForm %>
                    <div class="nsw-block">
                        {$DirectorySearchForm}
                    </div>
                <% end_if %>

                <div class="nsw-block">
                    <% include nswds/ResultsBar ResultsBar_Start=$DirectoryMembers.FirstItem, ResultsBar_End=$DirectoryMembers.LastItem, ResultsBar_Total=$DirectoryMembers.TotalItems, ResultsBar_ResultType='people', ResultsBar_ResultTypeSingular='person', ResultsBar_ClearFilters=$ClearResultsLink %>
                </div>

                <div class="nsw-block">
                <% include NSWDPC/Members/Directory DirectoryMembers=$DirectoryMembers %>
                </div>

                <% include nswds/Pagination Pagination_PaginatedItems=$DirectoryMembers %>


            </article>

        </main>

        <% if $IsKeywordLookup %>

            <aside class="nsw-layout__sidebar">
            </aside>

        <% end_if %>

    </div>

</div>
