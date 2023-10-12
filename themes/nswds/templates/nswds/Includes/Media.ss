<figure class="nsw-media<% if $Media_Brand %> nsw-media--{$Media_Brand.XML}<% end_if %><% if $Media_WidthOption %> nsw-media--<% if $Media_AlignOption %>{$Media_AlignOption}-<% end_if %>{$Media_WidthOption.XML}<% end_if %>"<% if $Media_Image %> data-original="{$Media_Image.AbsoluteURL.XML}"<% end_if %>>

<% if $Media_Image %>

    <div class="wrth-media__image">
    <% if Media_LinkToImage == 1 %><a <% if Media_GalleryClass %>class="{$Media_GalleryClass}"<% end_if %> href="{$Media_Image.ScaleMaxWidth(1920).AbsoluteURL.XML}"><% end_if %>

    <% if $Media_ImageWidth > 0 && $Media_ImageHeight > 0 %>
        {$Media_Image.FocusFill($Media_ImageWidth, $Media_ImageHeight)}
    <% else_if $Media_ImageWidth > 0 %>
        {$Media_Image.ScaleWidth($Media_ImageWidth)}
    <% else_if $Media_ImageHeight > 0 %>
        {$Media_Image.ScaleHeight($Media_ImageHeight)}
    <% else %>
        <%-- both are 0 --%>
        <img src="{$Media_Image.URL}" alt="{$Media_Image.AltText}" loading="lazy">
    <% end_if %>

    <% if Media_LinkToImage %></a><% end_if %>
    </div>


    <% if $Media_ShowCaption %>
        <% if $Media_Caption || $Media_Credit %>
            <figcaption>
            <% if $Media_Caption %>
                <p class="caption">
                <% if $Media_CaptionCharacterLimit > 0 %>
                    <% if $Media_CaptionEllipsis != '' %>
                        {$Media_Caption.LimitCharacters($Media_CaptionCharacterLimit, $Media_CaptionEllipsis)}
                    <% else %>
                        {$Media_Caption.LimitCharacters($Media_CaptionCharacterLimit)}
                    <% end_if %>
                <% else %>
                    {$Media_Caption.XML}
                <% end_if %>
                </p>
            <% end_if %>
            <% if $Media_Credit %>
                <p class="credit"><%t nswds.MEDIA_CREDIT 'Credit' %>: <span>{$Media_Credit.XML}</span></p>
            <% end_if %>
            </figcaption>
        <% end_if %>
    <% end_if %>

<% else_if $Media_Video %>

    <div class="wrth-media__video nsw-media__video">
        {$Media_EmbedCode.RAW}
    </div>

    <% if $Media_ShowCaption %>
        <% if $Media_Caption || $Media_Credit || $Media_AltVideoURL %>
            <figcaption>
            <% if $Media_Caption %>
                <p class="caption">
                <% if $Media_CaptionCharacterLimit > 0 %>
                    <% if $Media_CaptionEllipsis != '' %>
                        {$Media_Caption.LimitCharacters($Media_CaptionCharacterLimit, $Media_CaptionEllipsis)}
                    <% else %>
                        {$Media_Caption.LimitCharacters($Media_CaptionCharacterLimit)}
                    <% end_if %>
                <% else %>
                    {$Media_Caption.XML}
                <% end_if %>
                </p>
            <% end_if %>
            <% if $Media_Credit %>
                <p class="credit"><%t nswds.MEDIA_CREDIT 'Credit' %>: <span>{$Media_Credit.XML}</span></p>
            <% end_if %>
            <% if $Media_AltVideoURL %>
                <p class="alt-url">
                    <a href="$Media_AltVideoURL">
                        <% _t('nswds.WATCHWITHAUDIODESC','Watch this video with an audio description') %>
                    </a>
                </p>
            <% end_if %>
            </figcaption>
        <% end_if %>
    <% end_if %>

    <% if $Media_Transcript %>
        <div class="nsw-accordion js-accordion">
            <div class="nsw-accordion__title"><%t nswds.READ_TRANSCRIPT "Read transcript of the '{videoTitle}' video" videoTitle=$Title %></div>
            <div class="nsw-accordion__content">
                {$Media_Transcript}
            </div>
        </div>
    <% end_if %>

<% end_if %>

</figure>
