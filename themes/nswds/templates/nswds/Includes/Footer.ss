
{$PrimarySupportList}

<% if $Top.SiteConfig %>

<% with $Top.SiteConfig %>

<footer class="nsw-footer<% if $FooterBrand %> nsw-footer--{$FooterBrand.XML}<% else %> wrth-footer--default<% end_if %>">

    <% if $FooterLinksCol1 || $FooterLinksCol2 || $FooterLinksCol3 || $FooterLinksCol4 %>
        <div class="nsw-footer__upper">
            <div class="nsw-container">

                <% if $FooterLinksCol1 %>
                    <div class="nsw-footer__group">
                        <% if $FooterLinksCol1Title %>
                            <div class="nsw-footer__heading">
                                <h6>{$FooterLinksCol1Title.XML}</h6>
                            </div>
                        <% end_if %>
                        <% if $FooterLinksCol1 %>
                            <ul>
                                <% loop $FooterLinksCol1.Sort('Sort') %>
                                    <li>
                                        <a href="{$LinkURL}">
                                            {$Title.XML}
                                        </a>
                                    </li>
                                <% end_loop %>
                            </ul>
                        <% end_if %>
                    </div>
                <% end_if %>
                <% if $FooterLinksCol2 %>
                    <div class="nsw-footer__group">
                        <% if $FooterLinksCol2Title %>
                            <div class="nsw-footer__heading">
                                <h6>{$FooterLinksCol2Title.XML}</h6>
                            </div>
                        <% end_if %>
                        <% if $FooterLinksCol2 %>
                            <ul>
                                <% loop $FooterLinksCol2.Sort('Sort') %>
                                    <li>
                                        <a href="{$LinkURL}">
                                            {$Title.XML}
                                        </a>
                                    </li>
                                <% end_loop %>
                            </ul>
                        <% end_if %>
                    </div>
                <% end_if %>
                <% if $FooterLinksCol3 %>
                    <div class="nsw-footer__group">
                        <% if $FooterLinksCol3Title %>
                            <div class="nsw-footer__heading">
                                <h6>{$FooterLinksCol3Title.XML}</h6>
                            </div>
                        <% end_if %>
                        <% if $FooterLinksCol3 %>
                            <ul>
                                <% loop $FooterLinksCol3.Sort('Sort') %>
                                    <li>
                                        <a href="{$LinkURL}">
                                            {$Title.XML}
                                        </a>
                                    </li>
                                <% end_loop %>
                            </ul>
                        <% end_if %>
                    </div>
                <% end_if %>
                <% if $FooterLinksCol4 %>
                    <div class="nsw-footer__group">
                        <% if $FooterLinksCol4Title %>
                            <div class="nsw-footer__heading">
                                <h6>{$FooterLinksCol4Title.XML}</h6>
                            </div>
                        <% end_if %>
                        <% if $FooterLinksCol4 %>
                            <ul>
                                <% loop $FooterLinksCol4.Sort('Sort') %>
                                    <li>
                                        <a href="{$LinkURL}">
                                            {$Title.XML}
                                        </a>
                                    </li>
                                <% end_loop %>
                            </ul>
                        <% end_if %>
                    </div>
                <% end_if %>
            </div>
        </div>
    <% end_if %>

    <div class="nsw-footer__lower">

        <div class="nsw-container">

            <% if $Waratah_Endorsed == 'uncoupled' %>
            <div class="wrth-brand__endorsed--uncoupled nsw-p-y-sm">
                <% include nswds/Waratah_SVG Waratah_Height=88 %>
            </div>
            <% end_if %>

            <% if $DisplayWelcomeToCountry %>
                <p class="nsw-footer__acknowledgement">
                {$WelcomeToCountry.XML}
                </p>
                <% if $FooterContent == '' %>
                <hr>
                <% end_if %>
            <% end_if %>

            <% if $FooterContent %>
                <p>{$FooterContent.Plain.XML}</p>
                <hr>
            <% end_if %>


            <% if $FooterLinksSub  || $SocialLinks %>
            <div class="nsw-footer__links">
                <% if $FooterLinksSub %>
                <ul>
                    <% loop $FooterLinksSub.Sort('Sort') %>
                    <li>
                        <a href="{$LinkURL}" class="nsw-footer-links__link">
                            {$Title.XML}
                        </a>
                    </li>
                    <% end_loop %>
                </ul>
                <% end_if %>

                <% if $SocialLinks %>
                <div class="nsw-footer__social wrth-social-links">
                    <% loop $SocialLinks.Sort('Sort') %>
                        <a href="{$LinkURL}" rel="noopener" class="nsw-icon-button">
                            <% if $Image %>
                            {$Image.Fit(32,32)}
                            <span class="sr-only">{$Title.XML}</span>
                            <% else %>
                            {$Title.XML}
                            <% end_if %>
                        </a>
                    <% end_loop %>
                </div>
                <% end_if %>
            </div>
            <% end_if %>

            <div class="nsw-footer__info">
                <p class="nsw-footer__copyright">
                    <% if $CopyrightOwner %>{$CopyrightOwner.XML} <% else %><%t nswds.COPYRIGHT 'Copyright' %><% end_if %> &copy; {$Now.Year}
                </p>
            </div>

        </div>

    </div>

</footer>

<% end_with %>

<% end_if %>
