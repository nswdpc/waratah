<div class="nsw-container nsw-p-top-sm nsw-p-bottom-lg" data-page-type="2.sec">
    <div class="nsw-layout">


        <aside class="nsw-layout__sidebar">

            <% if $CurrentMember %>
            <nav class="nsw-side-nav js-side-nav" aria-labelledby="private-links">

                <button class="nsw-side-nav__toggle" aria-expanded="false">
                    <span><%t nswds.MENU 'Menu' %></span>
                </button>

                <div class="nsw-side-nav__header">
                    <a href="#" id="private-links"><%t nswds.MENU 'Menu' %></a>
                </div>

                <ul class="nsw-side-nav__content">
                    <% if $ProfileProvider %>
                        <% with $ProfileProvider %>
                            <li><a href="{$EditProfileLink}"><%t nswds.Profile 'Profile' %></a></li>
                        <% end_with %>
                    <% end_if %>
                    <% if $ChangePasswordProvider %>
                    <li>
                        <a href="{$Link('changepassword')}"><%t SilverStripe\\Security\\Member.BUTTONCHANGEPASSWORD 'Change password' %></a>
                    </li>
                    <% end_if %>
                    <li>
                        <a href="{$Link('logout')}"><%t SilverStripe\\Security\\Member.BUTTONLOGOUT 'Log out' %></a>
                    </li>
                </ul>

            </nav>
            <% else %>
            <nav class="nsw-side-nav js-side-nav" aria-labelledby="public-links">

                <button class="nsw-side-nav__toggle" aria-expanded="false">
                    <span><%t nswds.MENU 'Menu' %></span>
                </button>

                <div class="nsw-side-nav__header">
                    <a href="#" id="public-links"><%t nswds.MENU 'Menu' %></a>
                </div>

                <ul class="nsw-side-nav__content">
                    <li><a class="<% if $Action =='login' %>current<% end_if %>" href="{$Link('login')}"><%t nswds.SIGN_IN 'Sign in' %></a></li>
                    <% if $LostPasswordProvider %>
                    <li><a class="<% if $Action == 'lostpassword' %>current<% end_if %>" href="{$Link('lostpassword')}"><%t nswds.LOST_PASSWORD 'Lost password' %></a></li>
                    <% end_if %>
                    <% if $RegistrationProvider %>
                        <% with $RegistrationProvider %>
                            <li><a href="{$Link}"><%t nswds.REGISTER 'Register' %></a></li>
                        <% end_with %>
                    <% end_if %>
                </ul>

            </nav>
            <% end_if %>
        </aside>

        <main id="main-content" class="nsw-layout__main">

            <div class="nsw-block">

                <% include NSWDPC/Waratah/PageContentTitle Title=$Title %>

                <% if $Layout %>

                    {$Layout}

                <% else %>

                    <% if $Message %>
                        <% include nswds/InPageAlert InPageAlert_Content=$Message, InPageAlert_Level='info', InPageAlert_Icon='info',InPageAlert_Title='Information' %>
                    <% end_if %>

                    <% if $Content && $Content != $Message %>
                        <p class="nsw-intro">
                            {$Content}
                        </p>
                    <% end_if %>


                    <% if $Form %>
                        <div class="nsw-form">
                            {$Form}
                        </div>
                    <% end_if %>

                <% end_if %>

            </div>

        </main>

    </div>
</div>
