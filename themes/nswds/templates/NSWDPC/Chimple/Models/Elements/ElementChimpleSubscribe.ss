
<% if $SubscribeForm %>

    <div class="nsw-grid">

        <% if $Parent.IsSideArea %>

            <div class="nsw-col">

            <% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>

            <% if $BeforeFormContent %>
                <div class="nsw-intro">
                    {$BeforeFormContent}
                </div>
            <% end_if %>

            <% if $Image %>
            <div class="nsw-m-top-sm img-fluid">
            {$Image.FocusFillMax(720,600)}
            </div>
            <% end_if %>

            <div class="nsw-m-top-sm">
                {$SubscribeForm}
            </div>

            <% if $AfterFormContent %>
                <div class="nsw-m-top-sm">
                    {$AfterFormContent}
                </div>
            <% end_if %>

            </div>


        <% else %>

            <%-- main content area --%>

            <% if $Image %>
                <div class="nsw-col nsw-col-6">
            <% else %>
                <div class="nsw-col">
            <% end_if %>

                    <% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>

                    <% if $BeforeFormContent %>
                        <div class="nsw-intro">
                            {$BeforeFormContent}
                        </div>
                    <% end_if %>

                    <div class="nsw-m-top-sm">
                        {$SubscribeForm}
                    </div>

                    <% if $AfterFormContent %>
                        <div class="nsw-m-top-sm">
                            {$AfterFormContent}
                        </div>
                    <% end_if %>

                </div>

            <% if $Image %>

                <div class="nsw-col nsw-col-6">

                    <div class="img-fluid">
                    {$Image.FocusFillMax(720,600)}
                    </div>

                </div>

            <% end_if %>

        <% end_if %>

    </div>

<% end_if %>
