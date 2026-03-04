<% if $Id == 'global-exit-button' %>
    <%-- this implementation mirrors the quick exit component, we use our own JS implementation, see _exitbutton.scss for styling --%>
    <a class="wrth-exit__button wrth-exit__global-button" href="{$Url}" data-url="{$Url}" rel="nofollow noopener" id="{$Id}" aria-label="Quick exit" aria-describedby="wrth-exit__global-desc">
        <div class="wrth-exit__global-content">
            <span id="wrth-exit__global-desc" class="nsw-quick-exit__description-text">
                <%t nswds.QUICK_EXIT_LEAVE_INSTRUCTIONS 'Leave quickly using this banner or press' %> <kbd aria-label="<%t nswds.QUICK_EXIT_ESCAPE_KEY_TEXT 'Escape key' %>"><%t nswds.QUICK_EXIT_ESCAPE_KEY_NAME 'Esc' %></kbd> <%t nswds.QUICK_EXIT_ESCAPE_KEY_TWICE '2 times' %>.
            </span>
            <span class="nsw-quick-exit__exit-text wrth-exit__global-text"><% if $Label %>{$Label}<% else %><%t nswds.QUICK_EXIT_DEFAULT_ACTION_LABEL 'Exit now' %><% end_if %></span>
        </div>
    </a>
<% else %>
<div class="wrth-exit__button">
    <a class="nsw-button nsw-button--full-width" type="button" aria-expanded="true" id="{$Id}" class="page-exit" data-url="{$Url}" href="{$Url}" rel="nofollow noopener">
        <span><% if $Label %>{$Label}<% else %><%t nswds.QUICK_EXIT_DEFAULT_ACTION_LABEL 'Exit now' %><% end_if %></span>
        <span class="material-icons nsw-material-icons" focusable="false" aria-hidden="true">logout</span>
    </a>
</div>
<% end_if %>
