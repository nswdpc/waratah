<div id="{$ID}" class="readonly nsw-bg--off-white nsw-border nsw-border-1 nsw-border-grey-03 nsw-border-radius nsw-p-sm">
    {$Value}
</div>
<% if $IncludeHiddenField %>
    <input $getAttributesHTML("id", "type") id="hidden-{$ID}" type="hidden" />
<% end_if %>
