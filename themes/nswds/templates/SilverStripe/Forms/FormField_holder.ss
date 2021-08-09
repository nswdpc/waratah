<div id="$HolderID" class="nsw-form-group">

    <% if $Title %><label class="nsw-form-label left" for="$ID">$Title</label><% end_if %>

    <% if $Description %><span class="nsw-form-helper">$Description</span><% end_if %>

    {$Field}

    <% include nswds/FormFieldMessage Message=$Message, MessageType=$MessageType %>

    <% if $RightTitle %><span class="nsw-form-helper right" for="$ID">$RightTitle</span><% end_if %>

</div>