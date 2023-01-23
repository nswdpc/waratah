<div class="nsw-container nsw-p-top-sm nsw-p-bottom-lg" data-page-type="2.sec">
    <div class="nsw-layout">


        <aside class="nsw-layout__sidebar nsw-layout__sidebar--desktop">

            <% if $CurrentMember %>
            <nav class="nsw-side-nav" aria-labelledby="private-links">

                <div class="nsw-side-nav__header">
                    <a href="#" id="private-links"><%t nswds.MENU 'Menu' %></a>
                </div>

                <ul>
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
            <nav class="nsw-side-nav" aria-labelledby="public-links">

                <div class="nsw-side-nav__header">
                    <a href="#" id="public-links"><%t nswds.MENU 'Menu' %></a>
                </div>

                <ul>
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

                <% include NSWDPC/Waratah/PageContentTitle %>

                {$Layout}

            </div>

        </main>

    </div>
</div>
