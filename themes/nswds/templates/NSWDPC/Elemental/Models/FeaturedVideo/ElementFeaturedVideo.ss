<% if $Video && $Provider %>

<div class="wrth-video-featured">

        <% include NSWDPC/Waratah/ElementTitle ShowTitle=$ShowTitle, Title=$Title, HeadingLevel=$HeadingLevel %>


        <figure class="nsw-media wrth-video nsw-media--transparent">

            <% if $Image %>
                <%-- a linked video --%>
                <% include NSWDPC/Elemental/Models/FeaturedVideo/LinkedVideo %>
            <% else %>
                <div class="wrth-media__video nsw-media__video">
                    <% include NSWDPC/Waratah/IframeVideo Anchor=$Anchor, Media_Brand='transparent' %>
                </div>
            <% end_if %>

            <figcaption>

            <% if $DerivedFeatureLink || $Image %>

                <div class="nsw-row">

                    <div class="nsw-col nsw-col-xs-12 nsw-col-lg-9">

            <% end_if %>

                <% if $HTML %>
                    <%-- HTML content --%>
                    {$HTML}
                <% else_if $Description %>
                    <p>{$Description.XML}</p>
                <% end_if %>

            <% if $DerivedFeatureLink || $Image %>

                    </div>

                    <div class="nsw-col nsw-col-xs-12 nsw-col-lg-3">
                        <div class="more-link">
                            <% if $Image %>
                                <a class="nsw-button nsw-button--dark nsw-button--full-width" href="{$WatchURL}"><% include nswds/Icon Icon_Icon='play_circle' %><%t nswds.WATCH_VIDEO 'Watch' %></a>
                            <% else %>
                                <% with $DerivedFeatureLink %>
                                <a class="nsw-button nsw-button--dark nsw-button--full-width" href="{$LinkURL}" rel="noopener noreferrer"<% if $OpenInNewWindow %> target="_blank"<% end_if %>>
                                    {$Title}
                                </a>
                                <% end_with %>
                            <% end_if %>
                        </div>
                    </div>

                </div>

            <% end_if %>

            <% if $Transcript %>
                <div class="nsw-row">
                    <div class="nsw-col nsw-col-xs-12">
                        <details class="transcript">
                            <summary><%t nswds.READ_VIDEO_TRANSCRIPT "Read the transcript of the '{title}' video" title=$Title.XML %></summary>
                            {$Transcript}
                        </details>
                    </div>
                </div>
            <% end_if %>

            </figcaption>

        </figure>

</div>

<% end_if %>
