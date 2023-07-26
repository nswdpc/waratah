<% if $Modal_ModalID %>
<div class="wrth-mm<% if $Modal_ExtraClass %> {$Modal_ExtraClass}<% end_if %>" id="{$Modal_ModalID}"<% if $Modal_ShowOnLoad %> data-onload="{$Modal_ShowOnLoad}"<% end_if %><% if $Modal_AutoCloseAfter > 0 %> data-autoclose-after="{$Modal_AutoCloseAfter}"<% end_if %> aria-hidden="true">

    <div class="wrth-mm__overlay" tabindex="-1" data-micromodal-close>

        <div class="wrth-mm__container" role="dialog" aria-modal="true" aria-labelledby="{$Modal_ModalID}-title">

            <% if $Modal_ShowTitle && $Modal_Title %>
            <div class="wrth-mm__header nsw-block">
                <h2 id="{$Modal_ModalID}-title">{$Modal_Title.XML}</h2>
            </div>
            <% end_if %>

            <div class="wrth-mm__content nsw-block">
                <% if $Modal_Content %>
                <p>
                    {$Modal_Content}
                </p>
                <% end_if %>
                <% if $Modal_Image %>
                    <figure class="nsw-media nsw-media--left-50">
                        <% if $Modal_Link %><a href="$Modal_Link.LinkURL"><% end_if %>
                        <img src="{$Modal_Image.FitMax(600,600).URL}" alt="{$Modal_Image.AltText.XML}" loading="lazy">
                        <% if $Modal_Link %></a><% end_if %>
                    </figure>
                <% end_if %>
            </div>

            <div class="wrth-mm__footer nsw-block">
                <button class="wrth-mm__btn nsw-button nsw-button--light-outline" data-micromodal-close aria-label="<%t wrth.CLOSE_MODAL 'Close this dialog' %>">
                    <%t nswds.CLOSE 'Close' %>
                </button>
            </div>

        </div>

    </div>

</div>
<% end_if %>
