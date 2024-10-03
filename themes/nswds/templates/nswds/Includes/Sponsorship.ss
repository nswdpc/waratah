<div class="wrth-sponsorship">

    <div class="nsw-container">

        <% if Sponsorship_SupportLabel %>
            <h4 class="wrth-sponsorship__supportlabel">{$Sponsorship_SupportLabel}</h4>
        <% end_if %>

        <% if not $Sponsorship_MasterBrandDescriptorLinks %>

            <div class="wrth-sponsorship__container">

                <div class="wrth-sponsorship__descriptor">
                    <% include nswds/Sponsorship_Logos Sponsorship_Logos=$Sponsorship_Logos, Sponsorship_IncludeWaratah=$Sponsorship_IncludeWaratah %>
                </div>

            </div>

        <% else_if $Waratah_Masterbrand || $Waratah_CoBrand %>

            <div class="wrth-sponsorship__container">

                <div class="wrth-sponsorship__descriptor wrth-sponsorship__descriptor-mb">

                    <div class="wrth-sponsorship__nsw">
                        <p><%t nswds.SPONSORSHIP_NSW_GOVERNMENT 'NSW Government' %></p>
                    </div>

                    <div class="wrth-sponsorship__links">
                        <% loop $Sponsorship_MasterBrandDescriptorLinks %>
                            <a href="{$Link}">{$Title}</a>
                        <% end_loop %>
                    </div>

                </div>

                <% include nswds/Sponsorship_Logos Sponsorship_Logos=$Sponsorship_Logos, Sponsorship_IncludeWaratah=0 %>

            </div>


        <% else %>

            <div class="wrth-sponsorship__container">

                <div class="wrth-sponsorship__descriptor wrth-sponsorship__descriptor-ind">

                    <div class="wrth-sponsorship__nsw">
                        <% include nswds/Waratah_SVG Waratah_Height=76 %>
                    </div>

                    <div class="wrth-sponsorship__links">
                        <% loop $Sponsorship_MasterBrandDescriptorLinks %>
                            <a href="{$Link}">{$Title}</a>
                        <% end_loop %>
                    </div>

                </div>

                <% include nswds/Sponsorship_Logos Sponsorship_Logos=$Sponsorship_Logos, Sponsorship_IncludeWaratah=0 %>

            </div>

        <% end_if %>

    </div>

</div>
