<%-- This uses the wrth-feature component, not a nswds component --%>
<div class="wrth-feature">

    <% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>

    <% if $Subtitle %>
    <div class="nsw-p-bottom-sm">
        <p class="nsw-intro">{$Subtitle}</p>
    </div>
    <% end_if %>

    <% if $Image %>
        <div class="nsw-grid">
        <% if $ImageAlignment == "left" %>
            <div class="nsw-col nsw-col-xs-12 nsw-col-sm-4">
                <% include NSWDPC/Waratah/ElementDecoratedContent/ProfileImage %>
            </div>
            <div class="nsw-col nsw-col-xs-12 nsw-col-sm-8">
                <% include NSWDPC/Waratah/ElementDecoratedContent/ProfileContent %>
            </div>
        <% else %>
            <div class="nsw-col nsw-col-xs-12 nsw-col-sm-8">
                <% include NSWDPC/Waratah/ElementDecoratedContent/ProfileContent %>
            </div>
            <div class="nsw-col nsw-col-xs-12 nsw-col-sm-4">
                <% include NSWDPC/Waratah/ElementDecoratedContent/ProfileImage %>
            </div>
        <% end_if %>
        </div>
    <% else %>

        <% include NSWDPC/Waratah/ElementDecoratedContent/ProfileContent %>

    <% end_if %>

</div>



