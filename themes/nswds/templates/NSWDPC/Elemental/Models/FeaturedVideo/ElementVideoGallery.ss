<% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>

<% if $HTML %>
{$HTML}
<% end_if %>

<div class="wrth-video-gallery">

    <div class="nsw-grid" data-video-gallery="1">

        <% loop SortedVideos %>

            <div class="nsw-col {$Up.ColumnClass}">

                {$Me}

            </div>

        <% end_loop %>

    </div>
    <%-- grid --%>

</div>
