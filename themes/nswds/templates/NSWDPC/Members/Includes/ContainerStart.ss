<div class="nsw-container nsw-p-top-sm nsw-p-bottom-lg" data-page-type="2">
    <div class="nsw-layout">

        <aside class="nsw-layout__sidebar nsw-layout__sidebar--desktop">
            <% include NSWDPC/Members/Links %>

            <% if $HasSideElements %>
                {$SideElementalArea}
            <% end_if %>
        </aside>

        <main id="main-content" class="nsw-layout__main">

            <article>

                <div class="nsw-block">

                    <% include NSWDPC/Waratah/PageContentTitle %>

                    <% include NSWDPC/Waratah/PageContentAbstract %>

                    <% include NSWDPC/Members/Message %>

                </div>
