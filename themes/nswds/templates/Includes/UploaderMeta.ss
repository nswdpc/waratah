<div class="nsw-m-bottom-sm">
    <div class="nsw-callout">
        <div class="nsw-callout__content">
            <p class="nsw-h4">Upload requirements</p>
            <div class="dfu-uploader-meta">
            <ul>
                <li>Allowed files: $AcceptedExtensions</li>
                <li>Maximum file size: {$AcceptedFileSize}MB</li>
                <% if $AcceptedMinFileSize %><li>Minimum file size: {$AcceptedMinFileSize}MB</li><% end_if %>
                <li>Maximum number of uploads: $AcceptedItemLimit</li>
                <% if $AcceptsImages %>
                  <% if $AcceptedMaxDimensions %><li>Maximum image dimensions: $AcceptedMaxDimensions pixels</li><% end_if %>
                  <% if $AcceptedMinDimensions %><li>Minimum image dimensions: $AcceptedMinDimensions pixels</li><% end_if %>
                <% end_if %>
            </ul>
            </div>
        </div>
    </div>
</div>
