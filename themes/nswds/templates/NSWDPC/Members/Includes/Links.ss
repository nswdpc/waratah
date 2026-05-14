<% if $Member %>
<nav class="nsw-side-nav js-side-nav" aria-labelledby="profile-links">

    <button class="nsw-side-nav__toggle" aria-expanded="false">
        <span><%t nswds.PROFILE_LINKS 'Profile' %></span>
    </button>

    <div class="nsw-side-nav__header">
        <a id="profile-links" href="{$EditProfileLink.XML}"><%t nswds.PROFILE_LINKS 'Profile' %></a>
    </div>

    <ul class="nsw-side-nav__content">

        <% if $ProfilePages %>
            <li><a href="{$PageLink}"><%t nswds.PAGES 'Pages' %></a></li>
        <% end_if %>

        <% if $ProfileFolders %>
            <li><a href="{$FolderLink}"><%t nswds.FILES 'Files' %></a></li>
        <% end_if %>

        <% if $DirectoryLink %>
            <li><a href="{$DirectoryLink}"><%t nswds.DIRECTORY 'Directory' %></a></li>
        <% end_if %>

        <% if $MFALink %>
            <li><a href="{$MFALink}"><%t nswds.MULTI_FACTOR_AUTHENTICATION 'Multi-Factor Authentication (MFA)' %></a></li>
        <% end_if %>

        <li><a href="{$ChangePasswordLink}"><%t nswds.CHANGE_PASSWORD 'Change password' %></a></li>

    </ul>

</nav>

<% if $SignOutForm %>
    {$SignOutForm}
<% end_if %>

<% else %>

<nav class="nsw-side-nav js-side-nav" aria-labelledby="public-links">

    <button class="nsw-side-nav__toggle" aria-expanded="false">
        <span><%t nswds.MENU 'Menu' %></span>
    </button>

    <div class="nsw-side-nav__header">
        <a id="public-links" href="#"><%t nswds.MENU 'Menu' %></a>
    </div>

    <ul class="nsw-side-nav__content">
        <li><a class="<% if $Action =='login' %>current<% end_if %>" href="{$SignInLink}"><%t nswds.SIGN_IN 'Sign in' %></a></li>
        <li><a class="<% if $Action == 'lostpassword' %>current<% end_if %>" href="{$LostPasswordLink}"><%t nswds.LOST_PASSWORD 'Lost password' %></a></li>
        <li><a class="<% if $URLSegment == '_register' %>current<% end_if %>" href="{$RegisterLink}"><%t nswds.REGISTER 'Register' %></a></li>
    </ul>

</nav>

<% end_if %>
