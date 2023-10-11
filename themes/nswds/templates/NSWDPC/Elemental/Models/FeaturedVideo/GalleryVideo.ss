
    <%-- the video thumbnail --%>
    <figure class="nsw-media nsw-media--transparent wrth-video">

        <div class="placeholder">

            <a href="#gv-{$ID}-{$Parent.Anchor}" class="js-open-dialog-gv-{$ID}-{$Parent.Anchor}" aria-haspopup="dialog">

            <% if $UseVideoThumbnail == 1 && $VideoThumbnail %>
                <img src="{$VideoThumbnail}" class="video" referrerpolicy="no-referrer" loading="lazy">
            <% else_if $Image %>
                {$Image.FocusFill(720,405)}
            <% else %>
                <div class="noimage"></div>
            <% end_if %>

            </a>

        </div>

        <figcaption>

            <div class="nsw-grid nsw-grid--flush">
                <div class="nsw-col nsw-col-xs-12 nsw-col-md-7">

                    <% if $Title %><h4>{$Title.XML}</h4><% end_if %>

                </div>
                <div class="nsw-col nsw-col-xs-12 nsw-col-md-5">
                    <div class="more-link nsw-m-bottom-sm">
                        <button class="nsw-button nsw-button--light nsw-button--full-width js-open-dialog-gv-{$ID}-{$Parent.Anchor}" aria-haspopup="dialog"><% include nswds/Icon Icon_Icon='play_circle' %><%t nswds.WATCH_VIDEO 'Watch' %></button>
                    </div>
                </div>
            </div>

            <% if $HTML || $Description %>
            <div class="nsw-grid nsw-grid--flush">
                <div class="nsw-col nsw-col-xs-12">
                <% if $HTML %>
                    <%-- HTML content --%>
                    {$HTML}
                <% else_if $Description %>
                    <p>{$Description.XML}</p>
                <% end_if %>
                </div>
            </div>
            <% end_if %>

        </figcaption>

    </figure>

    <div class="nsw-dialog js-dialog" id="gv-{$ID}-{$Parent.Anchor}" role="dialog" aria-labelledby="gvt-{$ID}-{$Parent.Anchor}">

        <div class="nsw-dialog__wrapper">

            <div class="nsw-dialog__container">

                <div class="nsw-dialog__top">
                    <div class="nsw-dialog__title" id="gvt-{$ID}-{$Parent.Anchor}">
                        {$Title.XML}
                    </div>
                </div>

                <div class="nsw-dialog__content">

                    <figure class="nsw-media wrth-video">

                        <div class="wrth-media__video nsw-media__video">
                            <% include NSWDPC/Waratah/IframeVideo Anchor=$Parent.Anchor  %>
                        </div>

                    </figure>

                    <% if $Transcript %>
                    <h5><%t nswds.TRANSCRIPT_OF_VIDEO "Transcript of the '{title}' video" title=$Title.XML %></h5>
                    {$Transcript}
                    <% end_if %>

                </div>
            </div>

            <div class="nsw-dialog__bottom">
                <button class="nsw-button nsw-button--dark js-close-dialog"><%t nswds.CLOSE 'Close' %></button>
            </div>

        </div>

    </div>
